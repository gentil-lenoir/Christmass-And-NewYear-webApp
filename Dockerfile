FROM php:8.2-fpm-alpine

# 1. Installer uniquement ce qui est nécessaire
RUN apk update && apk add --no-cache \
    nginx \
    supervisor \
    curl

# 2. Installer extensions PHP minimales
RUN docker-php-ext-install pdo pdo_mysql

# 3. Définir le répertoire de travail
WORKDIR /var/www

# 4. Copier TOUT le code source
COPY . .

# 5. VÉRIFICATION - Afficher ce qui est copié
RUN echo "=== DEBUG: Liste des fichiers ===" && ls -la

# 6. Installer Composer (mais ne pas l'utiliser)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 7. CRÉER VENDOR SIMPLE
RUN mkdir -p vendor && \
    echo '<?php' > vendor/autoload.php && \
    echo '// Simple autoloader' >> vendor/autoload.php && \
    echo 'spl_autoload_register(function ($class) {' >> vendor/autoload.php && \
    echo '    if (strpos($class, "App\\\\") === 0) {' >> vendor/autoload.php && \
    echo '        $file = __DIR__ . "/../app/" . str_replace("\\\\", "/", substr($class, 4)) . ".php";' >> vendor/autoload.php && \
    echo '        if (file_exists($file)) { require $file; }' >> vendor/autoload.php && \
    echo '    }' >> vendor/autoload.php && \
    echo '});' >> vendor/autoload.php

# 8. Configurer Nginx - SIMPLIFIÉ
RUN mkdir -p /etc/nginx/conf.d && \
    echo 'server {' > /etc/nginx/conf.d/default.conf && \
    echo '    listen 80;' >> /etc/nginx/conf.d/default.conf && \
    echo '    server_name _;' >> /etc/nginx/conf.d/default.conf && \
    echo '    root /var/www/public;' >> /etc/nginx/conf.d/default.conf && \
    echo '    index index.php index.html;' >> /etc/nginx/conf.d/default.conf && \
    echo '' >> /etc/nginx/conf.d/default.conf && \
    echo '    location / {' >> /etc/nginx/conf.d/default.conf && \
    echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/conf.d/default.conf && \
    echo '    }' >> /etc/nginx/conf.d/default.conf && \
    echo '' >> /etc/nginx/conf.d/default.conf && \
    echo '    location ~ \.php$ {' >> /etc/nginx/conf.d/default.conf && \
    echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/conf.d/default.conf && \
    echo '        fastcgi_index index.php;' >> /etc/nginx/conf.d/default.conf && \
    echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/conf.d/default.conf && \
    echo '        include fastcgi_params;' >> /etc/nginx/conf.d/default.conf && \
    echo '    }' >> /etc/nginx/conf.d/default.conf && \
    echo '}' >> /etc/nginx/conf.d/default.conf

# 9. Créer un index.php de test SIMPLE
RUN if [ ! -d public ]; then mkdir -p public; fi && \
    echo '<?php' > public/index.php && \
    echo 'echo "<h1>Laravel Docker Test</h1>";' >> public/index.php && \
    echo 'echo "<p>Docker is working!</p>";' >> public/index.php && \
    echo 'if (function_exists("phpinfo")) {' >> public/index.php && \
    echo '    phpinfo();' >> public/index.php && \
    echo '}' >> public/index.php && \
    echo '?>' >> public/index.php

# 10. Configurer Supervisor - SIMPLIFIÉ
RUN echo '[supervisord]' > /etc/supervisord.conf && \
    echo 'nodaemon=true' >> /etc/supervisord.conf && \
    echo '' >> /etc/supervisord.conf && \
    echo '[program:php-fpm]' >> /etc/supervisord.conf && \
    echo 'command=php-fpm' >> /etc/supervisord.conf && \
    echo '' >> /etc/supervisord.conf && \
    echo '[program:nginx]' >> /etc/supervisord.conf && \
    echo 'command=nginx -g "daemon off;"' >> /etc/supervisord.conf

# 11. Permissions
RUN chmod -R 755 /var/www && \
    chown -R www-data:www-data /var/www

EXPOSE 80

CMD ["supervisord", "-n", "-c", "/etc/supervisord.conf"]