FROM php:8.2-fpm-alpine

# 1. Installer uniquement Nginx
RUN apk add --no-cache nginx

# 2. Extensions PHP
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# 3. Copier l'application
COPY . .

# 4. Configuration PHP-FPM simple
RUN echo '[global]' > /usr/local/etc/php-fpm.d/zz-docker.conf && \
    echo 'daemonize = no' >> /usr/local/etc/php-fpm.d/zz-docker.conf && \
    echo '[www]' >> /usr/local/etc/php-fpm.d/zz-docker.conf && \
    echo 'listen = 9000' >> /usr/local/etc/php-fpm.d/zz-docker.conf

# 5. Configuration Nginx
RUN echo 'events{}' > /etc/nginx/nginx.conf && \
    echo 'http {' >> /etc/nginx/nginx.conf && \
    echo '  server {' >> /etc/nginx/nginx.conf && \
    echo '    listen 80;' >> /etc/nginx/nginx.conf && \
    echo '    root /var/www/html/public;' >> /etc/nginx/nginx.conf && \
    echo '    index index.php;' >> /etc/nginx/nginx.conf && \
    echo '    location / {' >> /etc/nginx/nginx.conf && \
    echo '      try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/nginx.conf && \
    echo '    }' >> /etc/nginx/nginx.conf && \
    echo '    location ~ \.php$ {' >> /etc/nginx/nginx.conf && \
    echo '      fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/nginx.conf && \
    echo '      include fastcgi_params;' >> /etc/nginx/nginx.conf && \
    echo '      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/nginx.conf && \
    echo '    }' >> /etc/nginx/nginx.conf && \
    echo '  }' >> /etc/nginx/nginx.conf && \
    echo '}' >> /etc/nginx/nginx.conf

# 6. Créer index.php de test
RUN mkdir -p public && \
    echo '<?php echo "Laravel RNDR - OK"; ?>' > public/index.php

# 7. Script de démarrage simple mais efficace
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"

EXPOSE 80