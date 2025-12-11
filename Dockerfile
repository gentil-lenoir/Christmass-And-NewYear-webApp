FROM php:8.2-fpm-alpine

# 1. Installer uniquement Nginx et curl
RUN apk update && apk add --no-cache nginx curl

# 2. Installer UNIQUEMENT pdo et pdo_mysql (les plus simples)
RUN apk add --no-cache postgresql-dev && \
    docker-php-ext-install pdo pdo_mysql

# 3. Répertoire de travail
WORKDIR /var/www/html

# 4. Copier l'application
COPY . .

# 5. Créer un autoloader minimal
RUN mkdir -p vendor && \
    echo '<?php' > vendor/autoload.php && \
    echo '// Simple autoloader' >> vendor/autoload.php && \
    echo 'spl_autoload_register(function($class){' >> vendor/autoload.php && \
    echo '  if(strpos($class,"App\\\")===0){' >> vendor/autoload.php && \
    echo '    $f=__DIR__."/../app/".str_replace("\\\","/",substr($class,4)).".php";' >> vendor/autoload.php && \
    echo '    if(file_exists($f)) require $f;' >> vendor/autoload.php && \
    echo '  }' >> vendor/autoload.php && \
    echo '});' >> vendor/autoload.php

# 6. Configuration Nginx ultra simple
RUN echo 'events{}' > /etc/nginx/nginx.conf && \
    echo 'http{' >> /etc/nginx/nginx.conf && \
    echo '  server{' >> /etc/nginx/nginx.conf && \
    echo '    listen 80;' >> /etc/nginx/nginx.conf && \
    echo '    root /var/www/html/public;' >> /etc/nginx/nginx.conf && \
    echo '    index index.php;' >> /etc/nginx/nginx.conf && \
    echo '    location/{' >> /etc/nginx/nginx.conf && \
    echo '      try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/nginx.conf && \
    echo '    }' >> /etc/nginx/nginx.conf && \
    echo '    location~\.php${' >> /etc/nginx/nginx.conf && \
    echo '      fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/nginx.conf && \
    echo '      include fastcgi_params;' >> /etc/nginx/nginx.conf && \
    echo '      fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/nginx.conf && \
    echo '    }' >> /etc/nginx/nginx.conf && \
    echo '  }' >> /etc/nginx/nginx.conf && \
    echo '}' >> /etc/nginx/nginx.conf

# 7. Page d'accueil simple
RUN mkdir -p public && \
    echo '<?php' > public/index.php && \
    echo 'echo "Laravel RNDR - En ligne";' >> public/index.php && \
    echo 'echo "<br>PHP ".phpversion();' >> public/index.php && \
    echo '?>' >> public/index.php

EXPOSE 80
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]