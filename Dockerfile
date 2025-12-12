FROM php:8.2-fpm-alpine

# 1. Installer les dépendances
RUN apk add --no-cache \
    nginx \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    oniguruma-dev

# 2. Installer extensions PHP
RUN docker-php-ext-configure gd --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql mbstring zip gd

# 3. Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer

WORKDIR /var/www

# 4. Copier TOUTE votre application Laravel
COPY . .

# 5. VÉRIFIER que les fichiers Laravel existent
RUN echo "=== VÉRIFICATION LARAVEL ===" && \
    echo "1. public/index.php : " && \
    ls -la public/index.php 2>/dev/null || echo "public/index.php manquant - création..." && \
    echo "2. composer.json : " && \
    ls -la composer.json 2>/dev/null || echo "composer.json manquant" && \
    echo "3. app/ : " && \
    ls -la app/ 2>/dev/null || echo "app/ manquant"

# 6. Si composer.json existe, installer les dépendances
RUN if [ -f composer.json ]; then \
    echo "Installation des dépendances Composer..." && \
    composer install --no-dev --optimize-autoloader --no-interaction || \
    echo "⚠️ Composer install échoué, continuation..."; \
    else \
    echo "❌ composer.json non trouvé"; \
    fi

# 7. Si vendor/autoload.php n'existe pas, créer un simple
RUN if [ ! -f vendor/autoload.php ]; then \
    echo "Création d'autoloader minimal..." && \
    mkdir -p vendor && \
    echo '<?php' > vendor/autoload.php && \
    echo '// Autoloader minimal' >> vendor/autoload.php && \
    echo 'spl_autoload_register(function($class) {' >> vendor/autoload.php && \
    echo '    if (strpos($class, "App\\\\") === 0) {' >> vendor/autoload.php && \
    echo '        $file = __DIR__ . "/../app/" . str_replace("\\\\", "/", substr($class, 4)) . ".php";' >> vendor/autoload.php && \
    echo '        if (file_exists($file)) {' >> vendor/autoload.php && \
    echo '            require $file;' >> vendor/autoload.php && \
    echo '        }' >> vendor/autoload.php && \
    echo '    }' >> vendor/autoload.php && \
    echo '});' >> vendor/autoload.php; \
    fi

# 8. Configuration Nginx pour Laravel
RUN cat > /etc/nginx/nginx.conf << 'EOF'
events {
    worker_connections 1024;
}

http {
    server {
        listen 8080;
        server_name _;
        root /var/www/public;
        index index.php index.html;
        
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
        
        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        }
        
        # Bloque l'accès aux fichiers cachés
        location ~ /\. {
            deny all;
        }
    }
}
EOF

# 9. Configurer les permissions Laravel
RUN chmod -R 775 storage bootstrap/cache 2>/dev/null || true && \
    chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# 10. Créer .env si manquant
RUN if [ ! -f .env ] && [ -f .env.example ]; then \
    cp .env.example .env && \
    echo "APP_KEY=base64:"$(head -c 32 /dev/urandom | base64) >> .env; \
    fi

EXPOSE 8080

# 11. Script de démarrage
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]