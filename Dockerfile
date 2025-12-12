# Étape 1 : PHP-FPM 8.4
FROM php:8.4-fpm

# Installer les dépendances système et extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libjpeg-dev libonig-dev libxml2-dev libzip-dev \
    libpq-dev nginx \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install pdo_pgsql pdo_mysql mbstring zip exif gd

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html/public

# Copier tout le projet avant composer install (artisan présent)
COPY . .

# Copier le .env (assure-toi qu'il existe dans ton projet)
# Si tu veux, tu peux créer un .env.example et le renommer ici
# COPY .env.example .env

# Installer les dépendances PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Générer la clé Laravel si pas déjà dans .env
RUN php artisan key:generate || true

# Mettre les permissions correctes pour Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Copier la configuration Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Exposer le port 8080
EXPOSE 8080

# Lancer Nginx + PHP-FPM
CMD service nginx start && php-fpm
