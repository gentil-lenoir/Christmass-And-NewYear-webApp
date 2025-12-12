FROM php:8.2-fpm-alpine

# 1. Installer seulement Nginx
RUN apk add --no-cache nginx

# 2. Installer extensions PHP
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

# 3. Copier TOUTE l'application (y compris vendor/ si installé localement)
COPY . .

# 4. Créer un autoloader minimal SI vendor/ n'existe pas
RUN if [ ! -f vendor/autoload.php ]; then \
    echo "Création d'autoloader minimal..." && \
    mkdir -p vendor && \
    echo '<?php' > vendor/autoload.php && \
    echo '// Autoloader minimal pour Laravel' >> vendor/autoload.php && \
    echo 'spl_autoload_register(function ($class) {' >> vendor/autoload.php && \
    echo '    if (strpos($class, "App\\\\") === 0) {' >> vendor/autoload.php && \
    echo '        $file = __DIR__ . "/../app/" . str_replace("\\\\", "/", substr($class, 4)) . ".php";' >> vendor/autoload.php && \
    echo '        if (file_exists($file)) {' >> vendor/autoload.php && \
    echo '            require $file;' >> vendor/autoload.php && \
    echo '        }' >> vendor/autoload.php && \
    echo '    }' >> vendor/autoload.php && \
    echo '});' >> vendor/autoload.php; \
    fi

# 5. Configuration Nginx
RUN echo 'server {' > /etc/nginx/http.d/default.conf
RUN echo '    listen 8080;' >> /etc/nginx/http.d/default.conf
RUN echo '    root /var/www/public;' >> /etc/nginx/http.d/default.conf
RUN echo '    index index.php;' >> /etc/nginx/http.d/default.conf
RUN echo '    location / {' >> /etc/nginx/http.d/default.conf
RUN echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '    location ~ \.php$ {' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/http.d/default.conf
RUN echo '        include fastcgi_params;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '}' >> /etc/nginx/http.d/default.conf

# 6. Permissions
RUN chmod -R 775 storage bootstrap/cache 2>/dev/null || true

EXPOSE 8080

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]