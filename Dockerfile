FROM php:8.4-fpm

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    nginx \
    git curl zip unzip \
    libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo_pgsql mbstring zip exif gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copier tout le projet
COPY . .

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Générer APP_KEY si nécessaire
RUN php artisan key:generate --force || true

# Préparer storage et cache
RUN chmod -R 775 storage bootstrap/cache

# Copier configuration nginx
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf

# Entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

CMD ["/entrypoint.sh"]
