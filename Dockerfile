FROM php:8.2-fpm-alpine

# 1. Installer Nginx + outils réseau
RUN apk add --no-cache nginx curl

# 2. Installer extensions PHP essentielles (SANS sockets)
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# 3. Copier l'application
COPY . .

# 4. Configurer PHP-FPM
RUN echo '[global]' > /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'daemonize = no' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo '' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo '[www]' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'listen = 9000' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm = dynamic' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.max_children = 5' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.start_servers = 2' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.min_spare_servers = 1' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.max_spare_servers = 3' >> /usr/local/etc/php-fpm.d/zz-docker.conf

# 5. Configuration Nginx
RUN mkdir -p /etc/nginx/conf.d
RUN echo 'server {' > /etc/nginx/conf.d/default.conf
RUN echo '    listen 8080;' >> /etc/nginx/conf.d/default.conf  # PORT 8080 pour RNDR
RUN echo '    server_name _;' >> /etc/nginx/conf.d/default.conf
RUN echo '    root /var/www/html/public;' >> /etc/nginx/conf.d/default.conf
RUN echo '    index index.php index.html;' >> /etc/nginx/conf.d/default.conf
RUN echo '' >> /etc/nginx/conf.d/default.conf
RUN echo '    location / {' >> /etc/nginx/conf.d/default.conf
RUN echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/conf.d/default.conf
RUN echo '    }' >> /etc/nginx/conf.d/default.conf
RUN echo '' >> /etc/nginx/conf.d/default.conf
RUN echo '    location ~ \.php$ {' >> /etc/nginx/conf.d/default.conf
RUN echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/conf.d/default.conf
RUN echo '        fastcgi_index index.php;' >> /etc/nginx/conf.d/default.conf
RUN echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/conf.d/default.conf
RUN echo '        include fastcgi_params;' >> /etc/nginx/conf.d/default.conf
RUN echo '    }' >> /etc/nginx/conf.d/default.conf
RUN echo '}' >> /etc/nginx/conf.d/default.conf

# 6. Configuration Nginx principale
RUN echo 'events {' > /etc/nginx/nginx.conf
RUN echo '    worker_connections 1024;' >> /etc/nginx/nginx.conf
RUN echo '}' >> /etc/nginx/nginx.conf
RUN echo '' >> /etc/nginx/nginx.conf
RUN echo 'http {' >> /etc/nginx/nginx.conf
RUN echo '    include /etc/nginx/conf.d/*.conf;' >> /etc/nginx/nginx.conf
RUN echo '}' >> /etc/nginx/nginx.conf

# 7. Script de démarrage
RUN echo '#!/bin/sh' > /start.sh
RUN echo 'echo "Starting PHP-FPM..."' >> /start.sh
RUN echo 'php-fpm -D' >> /start.sh
RUN echo 'sleep 2' >> /start.sh
RUN echo 'echo "Starting Nginx on port 8080..."' >> /start.sh
RUN echo 'nginx -t' >> /start.sh
RUN echo 'exec nginx -g "daemon off;"' >> /start.sh
RUN chmod +x /start.sh

# 8. Page de test
RUN mkdir -p public
RUN echo '<?php' > public/index.php
RUN echo 'echo "<h1>Laravel RNDR</h1>";' >> public/index.php
RUN echo 'echo "<p>PHP " . phpversion() . "</p>";' >> public/index.php
RUN echo 'echo "<p>Extensions: pdo, pdo_mysql loaded</p>";' >> public/index.php
RUN echo 'echo "<p>Server: " . $_SERVER["SERVER_SOFTWARE"] . "</p>";' >> public/index.php
RUN echo '?>' >> public/index.php

EXPOSE 8080  
# IMPORTANT: Exposer le port 8080

CMD ["/start.sh"]