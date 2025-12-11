FROM php:8.2-fpm-alpine

# 1. Installer Nginx + outils réseau
RUN apk add --no-cache nginx curl

# 2. Installer extensions PHP essentielles
RUN docker-php-ext-install pdo pdo_mysql sockets

WORKDIR /var/www/html

# 3. Copier l'application
COPY . .

# 4. Configurer PHP-FPM pour écouter sur le réseau
RUN echo '[global]' > /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'daemonize = no' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo '' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo '[www]' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'listen = 0.0.0.0:9000' >> /usr/local/etc/php-fpm.d/zz-docker.conf  # CHANGÉ ICI
RUN echo 'listen.allowed_clients = any' >> /usr/local/etc/php-fpm.d/zz-docker.conf  # CHANGÉ ICI
RUN echo 'pm = dynamic' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.max_children = 5' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.start_servers = 2' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.min_spare_servers = 1' >> /usr/local/etc/php-fpm.d/zz-docker.conf
RUN echo 'pm.max_spare_servers = 3' >> /usr/local/etc/php-fpm.d/zz-docker.conf

# 5. Configuration Nginx corrigée
RUN mkdir -p /etc/nginx/conf.d
RUN echo 'server {' > /etc/nginx/conf.d/default.conf
RUN echo '    listen 80;' >> /etc/nginx/conf.d/default.conf
RUN echo '    server_name _;' >> /etc/nginx/conf.d/default.conf
RUN echo '    root /var/www/html/public;' >> /etc/nginx/conf.d/default.conf
RUN echo '    index index.php index.html;' >> /etc/nginx/conf.d/default.conf
RUN echo '' >> /etc/nginx/conf.d/default.conf
RUN echo '    location / {' >> /etc/nginx/conf.d/default.conf
RUN echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/conf.d/default.conf
RUN echo '    }' >> /etc/nginx/conf.d/default.conf
RUN echo '' >> /etc/nginx/conf.d/default.conf
RUN echo '    location ~ \.php$ {' >> /etc/nginx/conf.d/default.conf
RUN echo '        fastcgi_pass 0.0.0.0:9000;' >> /etc/nginx/conf.d/default.conf  # CHANGÉ ICI
RUN echo '        fastcgi_index index.php;' >> /etc/nginx/conf.d/default.conf
RUN echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/conf.d/default.conf
RUN echo '        include fastcgi_params;' >> /etc/nginx/conf.d/default.conf
RUN echo '        fastcgi_buffers 16 16k;' >> /etc/nginx/conf.d/default.conf
RUN echo '        fastcgi_buffer_size 32k;' >> /etc/nginx/conf.d/default.conf
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

# 7. Tester la connexion PHP-FPM
RUN echo '<?php' > test.php
RUN echo '// Test PHP-FPM' >> test.php
RUN echo '?>' >> test.php

# 8. Script de démarrage détaillé
RUN echo '#!/bin/sh' > /start.sh
RUN echo 'set -e' >> /start.sh
RUN echo '' >> /start.sh
RUN echo 'echo "=== Starting PHP-FPM ==="' >> /start.sh
RUN echo 'php-fpm -D' >> /start.sh
RUN echo 'sleep 2' >> /start.sh
RUN echo '' >> /start.sh
RUN echo '# Vérifier que PHP-FPM tourne' >> /start.sh
RUN echo 'if pgrep php-fpm > /dev/null; then' >> /start.sh
RUN echo '    echo "✅ PHP-FPM is running"' >> /start.sh
RUN echo '    echo "PHP-FPM processes:"' >> /start.sh
RUN echo '    ps aux | grep php-fpm' >> /start.sh
RUN echo 'else' >> /start.sh
RUN echo '    echo "❌ PHP-FPM failed to start"' >> /start.sh
RUN echo '    exit 1' >> /start.sh
RUN echo 'fi' >> /start.sh
RUN echo '' >> /start.sh
RUN echo 'echo "=== Starting Nginx ==="' >> /start.sh
RUN echo 'nginx -t' >> /start.sh
RUN echo 'exec nginx -g "daemon off;"' >> /start.sh

RUN chmod +x /start.sh

# 9. Page de test
RUN mkdir -p public
RUN echo '<?php' > public/index.php
RUN echo 'header("Content-Type: text/plain");' >> public/index.php
RUN echo 'echo "=== Laravel RNDR Test ===\n\n";' >> public/index.php
RUN echo 'echo "PHP Version: " . phpversion() . "\n";' >> public/index.php
RUN echo 'echo "PHP-FPM Status: " . (function_exists("fastcgi_finish_request") ? "Enabled" : "Disabled") . "\n";' >> public/index.php
RUN echo 'echo "Extensions: " . implode(", ", get_loaded_extensions()) . "\n";' >> public/index.php
RUN echo 'echo "\n=== Server Info ===\n";' >> public/index.php
RUN echo 'echo $_SERVER["SERVER_SOFTWARE"] . "\n";' >> public/index.php
RUN echo '?>' >> public/index.php

EXPOSE 80

# 10. Utiliser le script de démarrage
CMD ["/start.sh"]