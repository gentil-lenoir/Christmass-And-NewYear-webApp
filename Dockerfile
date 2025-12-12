# Étape 1 : PHP-FPM 8.4
FROM php:8.4-fpm

# Installer dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev nginx supervisor \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo_pgsql mbstring zip exif gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier tout le projet
COPY . .

# Installer dépendances Laravel
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Générer APP_KEY si vide
RUN php artisan key:generate --force

# Exécuter les migrations
RUN php artisan migrate --force

# Préparer storage et cache
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copier configuration nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copier configuration supervisor
COPY docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Exposer le port attendu par Render
EXPOSE 80

# Lancer le container via entrypoint
CMD ["/entrypoint.sh"]
