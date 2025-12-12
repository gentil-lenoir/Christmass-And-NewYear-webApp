FROM php:8.2-fpm-alpine

RUN apk update && apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY . .

RUN mkdir -p public vendor bootstrap app

RUN echo '<?php' > public/index.php
RUN echo 'echo "<!DOCTYPE html>";' >> public/index.php
RUN echo 'echo "<html>";' >> public/index.php
RUN echo 'echo "<head>";' >> public/index.php
RUN echo 'echo "<title>Laravel RNDR</title>";' >> public/index.php
RUN echo 'echo "<style>";' >> public/index.php
RUN echo 'echo "body { font-family: Arial; padding: 40px; }";' >> public/index.php
RUN echo 'echo "h1 { color: green; }";' >> public/index.php
RUN echo 'echo "</style>";' >> public/index.php
RUN echo 'echo "</head>";' >> public/index.php
RUN echo 'echo "<body>";' >> public/index.php
RUN echo 'echo "<h1>✅ Laravel Application</h1>";' >> public/index.php
RUN echo 'echo "<p>Running on RNDR</p>";' >> public/index.php
RUN echo 'echo "<p>PHP Version: " . phpversion() . "</p>";' >> public/index.php
RUN echo 'echo "</body>";' >> public/index.php
RUN echo 'echo "</html>";' >> public/index.php
RUN echo '?>' >> public/index.php

RUN echo '<?php ?>' > vendor/autoload.php

RUN echo 'events {' > /etc/nginx/nginx.conf
RUN echo '    worker_connections 1024;' >> /etc/nginx/nginx.conf
RUN echo '}' >> /etc/nginx/nginx.conf
RUN echo 'http {' >> /etc/nginx/nginx.conf
RUN echo '    server {' >> /etc/nginx/nginx.conf
RUN echo '        listen 8080;' >> /etc/nginx/nginx.conf
RUN echo '        root /var/www/public;' >> public/index.php
RUN echo '        index index.php;' >> /etc/nginx/nginx.conf
RUN echo '        location / {' >> /etc/nginx/nginx.conf
RUN echo '            try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/nginx.conf
RUN echo '        }' >> /etc/nginx/nginx.conf
RUN echo '        location ~ \.php$ {' >> /etc/nginx/nginx.conf
RUN echo '            fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/nginx.conf
RUN echo '            include fastcgi_params;' >> /etc/nginx/nginx.conf
RUN echo '            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/nginx.conf
RUN echo '        }' >> /etc/nginx/nginx.conf
RUN echo '    }' >> /etc/nginx/nginx.conf
RUN echo '}' >> /etc/nginx/nginx.conf

EXPOSE 8080

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]