FROM php:8.2-fpm

# Extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD ["php-fpm"]
