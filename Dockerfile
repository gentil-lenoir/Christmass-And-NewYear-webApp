FROM php:8.2-fpm-alpine

# 1. Installer Nginx seulement
RUN apk add --no-cache nginx

# 2. Installer une seule extension (la plus stable)
RUN docker-php-ext-install pdo_mysql

# 3. Définir le répertoire de travail
WORKDIR /var/www

# 4. Copier TOUTE votre application Laravel
COPY . .

# 5. Configuration Nginx SIMPLE (port 8080 pour RNDR)
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
RUN echo '        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/http.d/default.conf
RUN echo '    }' >> /etc/nginx/http.d/default.conf
RUN echo '}' >> /etc/nginx/http.d/default.conf

# 6. S'assurer que public/ existe
RUN mkdir -p public

# 7. Si pas de index.php Laravel, en créer un simple
RUN if [ ! -f public/index.php ] || [ $(wc -l < public/index.php 2>/dev/null || echo 0) -lt 5 ]; then \
    echo '<?php' > public/index.php; \
    echo 'echo "<h1>Laravel Application</h1>";' >> public/index.php; \
    echo 'echo "<p>PHP " . phpversion() . "</p>";' >> public/index.php; \
    echo '// Votre application Laravel sera chargée ici'; \
    echo 'if (file_exists(__DIR__ . "/../vendor/autoload.php")) {' >> public/index.php; \
    echo '    require __DIR__ . "/../vendor/autoload.php";' >> public/index.php; \
    echo '    $app = require_once __DIR__ . "/../bootstrap/app.php";' >> public/index.php; \
    echo '    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);' >> public/index.php; \
    echo '    $response = $kernel->handle($request = Illuminate\Http\Request::capture());' >> public/index.php; \
    echo '    $response->send();' >> public/index.php; \
    echo '    $kernel->terminate($request, $response);' >> public/index.php; \
    echo '}' >> public/index.php; \
    fi

# 8. Permissions basiques
RUN chmod -R 755 public && \
    chmod -R 775 storage 2>/dev/null || true

EXPOSE 8080

# 9. Commande simple
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]