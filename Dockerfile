# Étape 1 : PHP-FPM 8.4
FROM php:8.4-fpm

# Installer les dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev nginx \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo_pgsql mbstring zip exif gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier tout le projet
COPY . .

# Copier le .env.production en .env
RUN cp .env.production .env

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Générer la clé Laravel si elle n'existe pas
RUN php artisan key:generate || true

# Exécuter les migrations pour créer toutes les tables
RUN php artisan migrate --force

# Mettre les permissions correctes pour Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copier la configuration Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copier le script entrypoint
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Exposer le port 8080
EXPOSE 8080

# Lancer le container via entrypoint.sh
CMD ["/entrypoint.sh"]
