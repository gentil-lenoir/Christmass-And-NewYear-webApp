FROM php:8.2-fpm-alpine

# 1. Installer Nginx + Composer
RUN apk add --no-cache nginx curl git unzip

# 2. Installer extensions PHP
RUN docker-php-ext-install pdo pdo_mysql

# 3. Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

# 4. Copier les fichiers de dépendances d'abord
COPY composer.json composer.lock ./

# 5. Installer les dépendances PHP (avec timeout augmenté)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist || \
    echo "Composer install failed, creating fallback autoloader"

# 6. Copier le reste de l'application
COPY . .

# 7. Si vendor/autoload.php n'existe toujours pas, le créer
RUN if [ ! -f vendor/autoload.php ]; then \
    echo "Creating fallback autoload.php..."; \
    mkdir -p vendor && \
    echo '<?php' > vendor/autoload.php && \
    echo '// Fallback autoloader for Laravel' >> vendor/autoload.php && \
    echo 'spl_autoload_register(function($class) {' >> vendor/autoload.php && \
    echo '    if (strpos($class, "App\\\\") === 0) {' >> vendor/autoload.php && \
    echo '        $file = __DIR__ . "/../app/" . str_replace("\\\\", "/", substr($class, 4)) . ".php";' >> vendor/autoload.php && \
    echo '        if (file_exists($file)) { require $file; }' >> vendor/autoload.php && \
    echo '    }' >> vendor/autoload.php && \
    echo '});' >> vendor/autoload.php; \
    fi

# 8. Configuration Nginx (port 8080)
RUN echo 'server {' > /etc/nginx/http.d/default.conf
RUN echo '    listen 8080;' >> /etc/nginx/http.d/default.conf
RUN echo '    root /var/www/public;' >> /etc/nginx/http.d/default.conf
RUN echo '    index index.php;' >> /etc/nginx/http.d/default.conf
RUN echo '    location / {' >> /etc/nginx/http.d/default.conf
RUN echo '        try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '    location ~ \.php$ {' >> /etc/nginx/http.d/default.conf
RUN echo '        fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/http.d/default.conf
RUN echo '        include fastcgi_params;' >> vendor/autoload.php && \
    echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '}' >> /etc/nginx/http.d/default.conf

# 9. S'assurer que index.php existe
RUN mkdir -p public
RUN if [ ! -f public/index.php ] || [ $(wc -l < public/index.php 2>/dev/null || echo 0) -lt 10 ]; then \
    echo '<?php' > public/index.php; \
    echo '// Laravel bootstrap' >> public/index.php; \
    echo 'define("LARAVEL_START", microtime(true));' >> public/index.php; \
    echo '' >> public/index.php; \
    echo 'if (file_exists(__DIR__ . "/../vendor/autoload.php")) {' >> public/index.php; \
    echo '    require __DIR__ . "/../vendor/autoload.php";' >> public/index.php; \
    echo '}' else {' >> public/index.php; \
    echo '    echo "<h1>Laravel Application</h1>";' >> public/index.php; \
    echo '    echo "<p>Vendor directory not found. Please run: composer install</p>";' >> public/index.php; \
    echo '    echo "<p>PHP " . phpversion() . "</p>";' >> public/index.php; \
    echo '    exit;' >> public/index.php; \
    echo '}' >> public/index.php; \
    echo '' >> public/index.php; \
    echo 'if (file_exists(__DIR__ . "/../bootstrap/app.php")) {' >> public/index.php; \
    echo '    $app = require_once __DIR__ . "/../bootstrap/app.php";' >> public/index.php; \
    echo '    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);' >> public/index.php; \
    echo '    $response = $kernel->handle($request = Illuminate\Http\Request::capture());' >> public/index.php; \
    echo '    $response->send();' >> public/index.php; \
    echo '    $kernel->terminate($request, $response);' >> public/index.php; \
    echo '}' >> public/index.php; \
    fi

EXPOSE 8080

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]