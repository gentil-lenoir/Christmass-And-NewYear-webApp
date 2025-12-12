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

# 8. Assurer que le vrai index.php Laravel existe et est prêt
RUN if [ -f public/index.php ]; then \
    echo "✅ Le vrai index.php Laravel est présent"; \
    else \
    echo "⚠️  Création d'un index.php Laravel basique..."; \
    mkdir -p public && \
    cat > public/index.php << 'EOF'
<?php
/**
 * Laravel - A PHP Framework For Web Artisans
 */

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
EOF
    fi

# 9. S'assurer que bootstrap/autoload.php existe (pour compatibilité)
RUN if [ ! -f bootstrap/autoload.php ] && [ -f vendor/autoload.php ]; then \
    mkdir -p bootstrap && \
    echo '<?php define("LARAVEL_START", microtime(true)); require __DIR__."/../vendor/autoload.php"; ?>' > bootstrap/autoload.php; \
    fi

# 10. Configurer .env pour production
RUN if [ ! -f .env ] && [ -f .env.example ]; then \
    echo "Création de .env depuis .env.example..."; \
    cp .env.example .env; \
    fi

# 11. Générer APP_KEY si manquant
RUN if [ -f .env ] && ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then \
    echo "Génération de APP_KEY..."; \
    php -r "echo 'APP_KEY=' . 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;" >> .env; \
    fi

# 12. Configurer les permissions Laravel
RUN mkdir -p storage/framework/{sessions,views,cache} && \
    chown -R www-data:www-data storage bootstrap && \
    chmod -R 775 storage bootstrap/cache
    

EXPOSE 8080  
# IMPORTANT: Exposer le port 8080

CMD ["/start.sh"]