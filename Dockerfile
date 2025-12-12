FROM php:8.2-fpm-alpine

# Installer les dépendances système
RUN apk update && apk add --no-cache \
    nginx \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev

# Installer extensions PHP
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql mbstring zip gd

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# Répertoire de travail
WORKDIR /var/www

# 1. Copier les fichiers de configuration
COPY composer.json composer.lock ./

# 2. Installer les dépendances PRODUCTION
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# 3. Copier toute l'application
COPY . .

# 4. Configurer les permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 5. Créer .env si manquant
RUN if [ ! -f .env ]; then \
    if [ -f .env.example ]; then \
        cp .env.example .env; \
    fi; \
    fi

# 6. Générer la clé d'application
RUN php artisan key:generate --force --no-interaction 2>/dev/null || \
    echo "APP_KEY=base64:$(openssl rand -base64 32)" >> .env

# 7. Optimiser Laravel pour production
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# 8. Configuration Nginx PRODUCTION
RUN cat > /etc/nginx/nginx.conf << 'EOF'
events {
    worker_connections 1024;
}

http {
    include /etc/nginx/mime.types;
    default_type application/octet-stream;

    server {
        listen 8080;
        server_name _;
        root /var/www/public;
        index index.php index.html;

        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }

        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
            include fastcgi_params;
            fastcgi_hide_header X-Powered-By;
        }

        location ~ /\.(?!well-known).* {
            deny all;
        }
    }
}
EOF

EXPOSE 8080

# Commande de démarrage
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]