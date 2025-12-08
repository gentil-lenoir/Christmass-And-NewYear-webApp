FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libjpeg-dev libfreetype6-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist --optimize-autoloader

CMD ["php-fpm"]
