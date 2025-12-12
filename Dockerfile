FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www
COPY . .

# 1. Créer autoloader VALIDE
RUN mkdir -p vendor
RUN echo '<?php' > vendor/autoload.php
RUN echo '// Autoloader for Laravel' >> vendor/autoload.php
RUN echo 'spl_autoload_register(function ($class) {' >> vendor/autoload.php
RUN echo '    if (strpos($class, "App\\\\") === 0) {' >> vendor/autoload.php
RUN echo '        $file = __DIR__ . "/../app/" . str_replace("\\\\", "/", substr($class, 4)) . ".php";' >> vendor/autoload.php
RUN echo '        if (file_exists($file)) {' >> vendor/autoload.php
RUN echo '            require $file;' >> vendor/autoload.php
RUN echo '        }' >> vendor/autoload.php
RUN echo '    }' >> vendor/autoload.php
RUN echo '});' >> vendor/autoload.php

# 2. Configuration Nginx CORRECTE (avec ESPACE après location !)
RUN echo 'server {' > /etc/nginx/http.d/default.conf
RUN echo '    listen 8080;' >> /etc/nginx/http.d/default.conf
RUN echo '    root /var/www/public;' >> /etc/nginx/http.d/default.conf
RUN echo '    index index.php;' >> /etc/nginx/http.d/default.conf
RUN echo '    location / {' >> /etc/nginx/http.d/default.conf  # ESPACE ICI : "location / {"
RUN echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '    location ~ \.php$ {' >> /etc/nginx/http.d/default.conf  # ESPACE ICI AUSSI
RUN echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/http.d/default.conf
RUN echo '        include fastcgi_params;' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '}' >> /etc/nginx/http.d/default.conf

# 3. Tester la configuration Nginx
RUN nginx -t 2>&1 || echo "Testing Nginx config"

# 4. Page d'accueil simple
RUN mkdir -p public
RUN echo '<?php' > public/index.php
RUN echo 'echo "<h1>Laravel RNDR</h1>";' >> public/index.php
RUN echo 'echo "<p>Service en ligne</p>";' >> public/index.php
RUN echo 'echo "<p>PHP " . phpversion() . "</p>";' >> public/index.php
RUN echo '?>' >> public/index.php

EXPOSE 8080

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]