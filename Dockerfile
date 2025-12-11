FROM php:8.2-fpm-alpine

# Installer les dépendances système
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    curl \
    git \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    postgresql-dev \
    nodejs \
    npm \
    yarn

# Installer les extensions PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql pdo_pgsql mbstring zip exif pcntl gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Créer le répertoire de travail
WORKDIR /var/www

# Copier les fichiers de configuration des dépendances
COPY composer.json composer.lock ./

# Installer les dépendances PHP (avec gestion d'erreur)
RUN set -eux; \
    if [ -f composer.json ]; then \
        composer install --no-dev --optimize-autoloader --no-progress --no-scripts; \
    else \
        echo "composer.json not found, skipping Composer installation"; \
    fi

# Copier package.json pour Node
COPY package.json package-lock.json* ./

# Installer les dépendances Node
RUN set -eux; \
    if [ -f package.json ]; then \
        npm ci --only=production --silent; \
    else \
        echo "package.json not found, skipping npm installation"; \
    fi

# Copier toute l'application
COPY . .

# Déplacer dans le bon répertoire (si nécessaire)
RUN if [ -d /var/www/html ]; then cp -r /var/www/* /var/www/html/; fi

# Configurations
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Compiler les assets
RUN if [ -f package.json ] && [ -f vite.config.js ] || [ -f webpack.mix.js ]; then \
        npm run build; \
    elif [ -f artisan ]; then \
        php artisan config:clear; \
    fi

# Configurer les permissions
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Générer .env si nécessaire
RUN if [ ! -f .env ] && [ -f .env.example ]; then \
        cp .env.example .env \
        && php artisan key:generate --force; \
    fi

# Optimiser Laravel
RUN if [ -f artisan ]; then \
        php artisan config:cache \
        && php artisan route:cache \
        && php artisan view:cache; \
    fi

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]