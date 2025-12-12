FROM php:8.2-fpm-alpine

RUN apk add nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
COPY . .

# Autoloader SIMPLE et VALIDE
RUN mkdir -p vendor
RUN echo '<?php' > vendor/autoload.php
RUN echo '// Simple autoloader for App namespace' >> vendor/autoload.php
RUN echo 'spl_autoload_register(function ($class_name) {' >> vendor/autoload.php
RUN echo '    $prefix = "App\\\\";' >> vendor/autoload.php
RUN echo '    $base_dir = __DIR__ . "/../app/";' >> vendor/autoload.php
RUN echo '    $len = strlen($prefix);' >> vendor/autoload.php
RUN echo '    if (strncmp($prefix, $class_name, $len) !== 0) {' >> vendor/autoload.php
RUN echo '        return;' >> vendor/autoload.php
RUN echo '    }' >> vendor/autoload.php
RUN echo '    $relative_class = substr($class_name, $len);' >> vendor/autoload.php
RUN echo '    $file = $base_dir . str_replace("\\\\", "/", $relative_class) . ".php";' >> vendor/autoload.php
RUN echo '    if (file_exists($file)) {' >> vendor/autoload.php
RUN echo '        require $file;' >> vendor/autoload.php
RUN echo '    }' >> vendor/autoload.php
RUN echo '});' >> vendor/autoload.php

# Nginx
RUN echo 'server{listen 8080;root /var/www/public;index index.php;location/{try_files $uri $uri/ /index.php?$query_string;}location~\.php${fastcgi_pass 127.0.0.1:9000;include fastcgi_params;}}' > /etc/nginx/http.d/default.conf

# Page de test
RUN mkdir -p public
RUN echo '<?php' > public/index.php
RUN echo 'echo "Hello Laravel!";' >> public/index.php
RUN echo '?>' >> public/index.php

EXPOSE 8080
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"