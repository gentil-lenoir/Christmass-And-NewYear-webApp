#!/bin/bash
echo "=== PRÉPARATION POUR DOCKER ==="

# 1. Installer les dépendances localement
composer install --no-dev --optimize-autoloader

# 2. Créer un Dockerfile qui ne lance PAS composer install
cat > Dockerfile << 'EOF'
FROM php:8.2-fpm-alpine

# Installer les bases
RUN apk add --no-cache nginx supervisor

# Copier l'application AVEC le vendor déjà installé
WORKDIR /var/www
COPY . .

# Simple config Nginx
RUN echo 'server {
    listen 8080;
    root /var/www/public;
    index index.php;
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}' > /etc/nginx/conf.d/default.conf

# Démarrer
CMD ["sh", "-c", "nginx && php-fpm"]
EOF

echo "=== PRÊT! Maintenant construisez avec: ==="
echo "docker build -t laravel-app ."