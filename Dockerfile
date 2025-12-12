FROM php:8.2-fpm-alpine

# 1. Installer les dépendances système
RUN apk update && apk add --no-cache \
    nginx \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev \
    nodejs \
    npm

# 2. Installer extensions PHP
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql mbstring zip gd

# 3. Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# 4. Répertoire de travail
WORKDIR /var/www

# 5. Copier les fichiers de configuration
COPY composer.json composer.lock ./

# 6. Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# 7. Copier toute l'application
COPY . .

# 8. Installer dépendances Node si présentes
RUN if [ -f package.json ]; then \
    npm ci --only=production --silent; \
    fi

# 9. Compiler les assets
RUN if [ -f package.json ] && [ -f vite.config.js ] || [ -f webpack.mix.js ]; then \
    npm run production; \
    fi

# 10. Configurer les permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 11. Créer .env pour production
RUN if [ ! -f .env ]; then \
    if [ -f .env.production ]; then \
        cp .env.production .env; \
    elif [ -f .env.example ]; then \
        cp .env.example .env; \
    fi; \
    fi

# 12. Générer la clé d'application
RUN php artisan key:generate --force --no-interaction 2>/dev/null || \
    php -r "file_put_contents('.env', preg_replace('/^APP_KEY=.*/m', 'APP_KEY=base64:'.base64_encode(random_bytes(32)), file_get_contents('.env')));"

# 13. Optimiser Laravel
RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache

# 14. Configuration Nginx pour production
RUN echo 'server {' > /etc/nginx/http.d/default.conf
RUN echo '    listen 8080;' >> /etc/nginx/http.d/default.conf
RUN echo '    server_name _;' >> /etc/nginx/http.d/default.conf
RUN echo '    root /var/www/public;' >> /etc/nginx/http.d/default.conf
RUN echo '    index index.php index.html;' >> /etc/nginx/http.d/default.conf
RUN echo '' >> /etc/nginx/http.d/default.conf
RUN echo '    add_header X-Frame-Options "SAMEORIGIN";' >> /etc/nginx/http.d/default.conf
RUN echo '    add_header X-Content-Type-Options "nosniff";' >> /etc/nginx/http.d/default.conf
RUN echo '' >> /etc/nginx/http.d/default.conf
RUN echo '    location / {' >> /etc/nginx/http.d/default.conf
RUN echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '' >> /etc/nginx/http.d/default.conf
RUN echo '    location ~ \.php$ {' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;' >> /etc/nginx/http.d/default.conf
RUN echo '        include fastcgi_params;' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_hide_header X-Powered-By;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '' >> /etc/nginx/http.d/default.conf
RUN echo '    location ~ /\.(?!well-known).* {' >> /etc/nginx/http.d/default.conf
RUN echo '        deny all;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '}' >> /etc/nginx/http.d/default.conf

EXPOSE 8080

# 15. Script de santé pour RNDR
HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:8080/ || exit 1

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]