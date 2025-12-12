FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html
COPY . .

# PHP-FPM config
RUN echo '[www]' > /usr/local/etc/php-fpm.d/zz.conf
RUN echo 'listen = 9000' >> /usr/local/etc/php-fpm.d/zz.conf

# Nginx config (port 8080)
RUN echo 'server{listen 8080;root /var/www/html/public;index index.php;location/{try_files $uri $uri/ /index.php?$query_string;}location~\.php${fastcgi_pass 127.0.0.1:9000;include fastcgi_params;}}' > /etc/nginx/http.d/default.conf

# S'assurer que public/index.php existe
RUN if [ ! -f public/index.php ]; then \
    mkdir -p public && \
    echo '<?php' > public/index.php && \
    echo 'define("LARAVEL_START", microtime(true));' >> public/index.php && \
    echo 'require __DIR__."/../vendor/autoload.php";' >> public/index.php && \
    echo '$app = require_once __DIR__."/../bootstrap/app.php";' >> public/index.php && \
    echo '$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);' >> public/index.php && \
    echo '$response = $kernel->handle($request = Illuminate\Http\Request::capture());' >> public/index.php && \
    echo '$response->send();' >> public/index.php && \
    echo '$kernel->terminate($request, $response);' >> public/index.php; \
    fi

EXPOSE 8080
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"