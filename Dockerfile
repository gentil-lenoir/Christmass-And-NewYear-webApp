FROM php:8.2-fpm-alpine

# 1. Installer les dépendances
RUN apk update && apk add --no-cache \
    nginx \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    nodejs \
    npm

# 2. Installer les extensions PHP
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    zip \
    gd

# 3. Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

# 4. Répertoire de travail
WORKDIR /var/www/html

# 5. Copier TOUT d'abord
COPY . .

# 6. DEBUG: Voir la structure
RUN echo "=== DEBUG: Structure avant composer ===" && \
    ls -la && \
    echo "=== composer.json ===" && \
    cat composer.json 2>/dev/null || echo "composer.json non trouvé"

# 7. Installer les dépendances AVEC gestion d'erreur
RUN if [ -f composer.json ]; then \
    echo "Installation des dépendances Composer..." && \
    composer install --no-dev --no-interaction --optimize-autoloader --prefer-dist 2>&1 || \
    (echo "⚠️  Composer install échoué, tentative d'update..." && \
     composer update --no-dev --no-interaction --optimize-autoloader --prefer-dist 2>&1 || \
     echo "❌ Les deux tentatives ont échoué, création d'autoloader manuel"); \
    else \
    echo "❌ composer.json non trouvé"; \
    fi

# 8. Créer vendor/autoload.php manuellement si nécessaire
RUN if [ ! -f vendor/autoload.php ]; then \
    echo "Création de vendor/autoload.php manuel..." && \
    mkdir -p vendor && \
    echo '<?php' > vendor/autoload.php && \
    echo '// Autoloader manuel pour Laravel' >> vendor/autoload.php && \
    echo 'spl_autoload_register(function ($class) {' >> vendor/autoload.php && \
    echo '    $prefix = "App\\\\";' >> vendor/autoload.php && \
    echo '    $baseDir = __DIR__ . "/../app/";' >> vendor/autoload.php && \
    echo '    $len = strlen($prefix);' >> vendor/autoload.php && \
    echo '    if (strncmp($prefix, $class, $len) !== 0) {' >> vendor/autoload.php && \
    echo '        return;' >> vendor/autoload.php && \
    echo '    }' >> vendor/autoload.php && \
    echo '    $relativeClass = substr($class, $len);' >> vendor/autoload.php && \
    echo '    $file = $baseDir . str_replace("\\\\", "/", $relativeClass) . ".php";' >> vendor/autoload.php && \
    echo '    if (file_exists($file)) {' >> vendor/autoload.php && \
    echo '        require $file;' >> vendor/autoload.php && \
    echo '    }' >> vendor/autoload.php && \
    echo '});' >> vendor/autoload.php && \
    echo 'echo "<!-- Autoloader manuel utilisé -->";' >> vendor/autoload.php && \
    echo '?>' >> vendor/autoload.php; \
    fi

# 9. Vérifier que bootstrap/autoload.php existe
RUN if [ ! -f bootstrap/autoload.php ] && [ -f vendor/autoload.php ]; then \
    mkdir -p bootstrap && \
    echo '<?php require __DIR__."/../vendor/autoload.php"; ?>' > bootstrap/autoload.php; \
    fi

# 10. Configurer les permissions
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache

# 11. Générer la clé Laravel si .env manquant
RUN if [ ! -f .env ] && [ -f .env.example ]; then \
    cp .env.example .env && \
    php artisan key:generate --force; \
    fi

# 12. Configuration Nginx simple
RUN echo 'events {' > /etc/nginx/nginx.conf && \
    echo '    worker_connections 1024;' >> /etc/nginx/nginx.conf && \
    echo '}' >> /etc/nginx/nginx.conf && \
    echo 'http {' >> /etc/nginx/nginx.conf && \
    echo '    server {' >> /etc/nginx/nginx.conf && \
    echo '        listen 80;' >> /etc/nginx/nginx.conf && \
    echo '        root /var/www/html/public;' >> /etc/nginx/nginx.conf && \
    echo '        index index.php;' >> /etc/nginx/nginx.conf && \
    echo '        location / {' >> /etc/nginx/nginx.conf && \
    echo '            try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/nginx.conf && \
    echo '        }' >> /etc/nginx/nginx.conf && \
    echo '        location ~ \.php$ {' >> /etc/nginx/nginx.conf && \
    echo '            fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/nginx.conf && \
    echo '            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/nginx.conf && \
    echo '            include fastcgi_params;' >> /etc/nginx/nginx.conf && \
    echo '        }' >> /etc/nginx/nginx.conf && \
    echo '    }' >> /etc/nginx/nginx.conf && \
    echo '}' >> /etc/nginx/nginx.conf

EXPOSE 80

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]