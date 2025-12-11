#!/bin/bash
set -x  # Mode debug

echo "=== ÉTAPE 1: Nettoyage ==="
docker system prune -af

echo "=== ÉTAPE 2: Test avec image minimaliste ==="
cat > Dockerfile.test << 'EOF'
FROM alpine:latest
RUN echo "Test image works!" && ls -la
EOF

docker build -f Dockerfile.test -t test-image .

echo "=== ÉTAPE 3: Vérifier les fichiers ==="
ls -la
echo "composer.json existe?" && test -f composer.json && echo "OUI" || echo "NON"

echo "=== ÉTAPE 4: Build avec logs complets ==="
cat > Dockerfile.mini << 'EOF'
FROM php:8.2-fpm-alpine
RUN apk add --no-cache curl
WORKDIR /var/www
COPY composer.json .
RUN curl -s https://getcomposer.org/installer | php && \
    php composer.phar diagnose
EOF

docker build -f Dockerfile.mini --progress=plain . 2>&1 | tail -50