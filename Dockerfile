FROM php:8.2-fpm-alpine

# 1. Installer uniquement ce qui est ABSOLUMENT nécessaire
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

# 5. VÉRIFICATION CRITIQUE - Afficher ce qui est copié
RUN echo "=== CONTENU DU RÉPERTOIRE ===" && \
    ls -la && \
    echo "=== COMPOSER.JSON EXISTE ? ===" && \
    if [ -f composer.json ]; then cat composer.json; else echo "NON TROUVÉ"; fi && \
    echo "=== TAILLE DU PROJET ===" && \
    du -sh . && \
    echo "=== PERMISSIONS ===" && \
    ls -la composer.json 2>/dev/null || echo "composer.json absent"

# 6. Installer Composer SANS l'utiliser pour l'instant
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# 7. CRÉER VENDOR MANUELLEMENT (solution d'urgence)
RUN echo "=== CRÉATION DE VENDOR ALTERNATIVE ===" && \
    mkdir -p vendor && \
    printf '<?php\n// Vendor autoload factice\nspl_autoload_register(function ($class) {\n    $prefix = "App\\\\\\\\";\n    $base_dir = __DIR__ . "/../app/";\n    $len = strlen($prefix);\n    if (strncmp($prefix, $class, $len) !== 0) return;\n    $relative_class = substr($class, $len);\n    $file = $base_dir . str_replace("\\\\\\\\", "/", $relative_class) . ".php";\n    if (file_exists($file)) require $file;\n});\n' > vendor/autoload.php

# 8. Configurer Nginx (ultra simple)
RUN printf 'server {\n    listen 80;\n    root /var/www/public;\n    index index.php;\n    \n    location / {\n        try_files $uri $uri/ /index.php?\$query_string;\n    }\n    \n    location ~ \.php\$ {\n        fastcgi_pass 127.0.0.1:9000;\n        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;\n        include fastcgi_params;\n    }\n}\n' > /etc/nginx/conf.d/default.conf

# 9. Créer un index.php de test
RUN if [ ! -f public/index.php ]; then \
    mkdir -p public && \
    printf '<?php\necho "<h1>Laravel Docker Test</h1>";\necho "<p>If you see this, Docker works!</p>";\nphpinfo();\n?>\n' > public/index.php; \
    fi

# 10. Configurer Supervisor simple
RUN printf '[supervisord]\nnodaemon=true\n\n[program:php-fpm]\ncommand=php-fpm\n\n[program:nginx]\ncommand=nginx -g "daemon off;"\nstdout_logfile=/dev/stdout\nstdout_logfile_maxbytes=0\nstderr_logfile=/dev/stderr\nstderr_logfile_maxbytes=0\n' > /etc/supervisord.conf

# 11. S'assurer que Nginx peut lire les fichiers
RUN chown -R www-data:www-data /var/www && \
    chmod -R 755 /var/www

EXPOSE 80
CMD ["supervisord", "-n", "-c", "/etc/supervisord.conf"]