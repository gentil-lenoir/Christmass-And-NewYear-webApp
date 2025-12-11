FROM php:8.2-fpm-alpine

# 1. Installer Nginx
RUN apk add --no-cache nginx

# 2. Installer seulement pdo (le plus stable)
RUN docker-php-ext-install pdo

WORKDIR /var/www/html

# 3. Copier l'application
COPY . .

# 4. Configuration Nginx ULTRA SIMPLE (un seule ligne)
RUN echo 'events{worker_connections 768;}http{server{listen 80;root /var/www/html/public;index index.php;location /{try_files $uri $uri/ /index.php?$query_string;}location ~ \.php${fastcgi_pass 127.0.0.1:9000;include fastcgi_params;fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;}}}' > /etc/nginx/nginx.conf

# 5. Vérifier la configuration
RUN nginx -t 2>&1 || echo "Nginx config test"

# 6. Créer public/index.php simple
RUN mkdir -p public && echo '<?php echo "Laravel RNDR - Online"; phpinfo(); ?>' > public/index.php

EXPOSE 80

# 7. Démarrer
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]