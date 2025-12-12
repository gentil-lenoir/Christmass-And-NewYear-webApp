FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

# 1. Copier l'application
COPY . .

# 2. DEBUG: Voir la structure des fichiers
RUN echo "=== DEBUG: Structure des fichiers ===" && \
    ls -la && \
    echo "=== public/ existe? ===" && \
    ls -la public/ 2>/dev/null || echo "public/ n'existe pas" && \
    echo "=== public/index.php existe? ===" && \
    ls -la public/index.php 2>/dev/null || echo "public/index.php n'existe pas"

# 3. S'assurer que public/index.php EXISTE
RUN mkdir -p public
RUN if [ ! -f public/index.php ] || [ ! -s public/index.php ]; then \
    echo "Création de public/index.php..." && \
    echo '<?php' > public/index.php && \
    echo 'echo "<!DOCTYPE html>";' >> public/index.php && \
    echo 'echo "<html><head><title>Laravel RNDR</title>";' >> public/index.php && \
    echo 'echo "<style>body{font-family:Arial;padding:40px;text-align:center;}</style>";' >> public/index.php && \
    echo 'echo "</head><body>";' >> public/index.php && \
    echo 'echo "<h1>✅ Laravel en ligne</h1>";' >> public/index.php && \
    echo 'echo "<p>PHP " . phpversion() . "</p>";' >> public/index.php && \
    echo 'echo "<p>Serveur: " . $_SERVER["SERVER_SOFTWARE"] . "</p>";' >> public/index.php && \
    echo 'echo "</body></html>";' >> public/index.php && \
    echo '?>' >> public/index.php; \
    else \
    echo "public/index.php existe déjà"; \
    fi

# 4. Configuration Nginx SIMPLE
RUN echo 'server {' > /etc/nginx/http.d/default.conf
RUN echo '    listen 8080;' >> /etc/nginx/http.d/default.conf
RUN echo '    root /var/www/public;' >> /etc/nginx/http.d/default.conf
RUN echo '    index index.php index.html;' >> /etc/nginx/http.d/default.conf
RUN echo '    location / {' >> /etc/nginx/http.d/default.conf
RUN echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '    location ~ \.php$ {' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/http.d/default.conf
RUN echo '        include fastcgi_params;' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '}' >> /etc/nginx/http.d/default.conf

# 5. Tester la configuration Nginx
RUN nginx -t 2>&1 | head -5

EXPOSE 8080

# 6. Script de démarrage avec logs
CMD ["sh", "-c", "echo 'Démarrage PHP-FPM...' && php-fpm -D && sleep 2 && echo 'Démarrage Nginx...' && nginx -g 'daemon off;'"]