# # 1. Allez dans votre projet
# cd /chemin/vers/votre-projet

# # 2. SUPPRIMEZ l'ancien Dockerfile s'il existe
# rm -f Dockerfile

# 3. Créez le nouveau Dockerfile avec echo
echo 'FROM php:8.2-fpm-alpine' > Dockerfile
echo '' >> Dockerfile
echo 'RUN apk add --no-cache nginx' >> Dockerfile
echo 'RUN docker-php-ext-install pdo pdo_mysql' >> Dockerfile
echo '' >> Dockerfile
echo 'WORKDIR /var/www' >> Dockerfile
echo '' >> Dockerfile
echo 'COPY public/ public/' >> Dockerfile
echo 'COPY app/ app/ 2>/dev/null || mkdir -p app' >> Dockerfile
echo 'COPY bootstrap/ bootstrap/ 2>/dev/null || mkdir -p bootstrap' >> Dockerfile
echo 'COPY vendor/ vendor/ 2>/dev/null || mkdir -p vendor' >> Dockerfile
echo '' >> Dockerfile
echo 'RUN echo '"'"'<?php'"'"' > public/index.php' >> Dockerfile
echo 'RUN echo '"'"'echo "<h1>Laravel sur RNDR</h1>";'"'"' >> public/index.php' >> Dockerfile
echo 'RUN echo '"'"'echo "<p>PHP " . phpversion() . "</p>";'"'"' >> public/index.php' >> Dockerfile
echo 'RUN echo '"'"'?>'"'"' >> public/index.php' >> Dockerfile
echo '' >> Dockerfile
echo 'RUN echo '"'"'events{}'"'"' > /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'http{'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'  server{'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'    listen 8080;'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'    root /var/www/public;'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'    index index.php;'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'    location / {'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'      try_files $uri $uri/ /index.php?$query_string;'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'    }'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'    location ~ \.php$ {'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'      fastcgi_pass 127.0.0.1:9000;'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'      include fastcgi_params;'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'    }'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'  }'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo 'RUN echo '"'"'}'"'"' >> /etc/nginx/nginx.conf' >> Dockerfile
echo '' >> Dockerfile
echo 'EXPOSE 8080' >> Dockerfile
echo '' >> Dockerfile
echo 'CMD ["sh", "-c", "php-fpm -D && nginx -g '"'"'daemon off;'"'"'"]' >> Dockerfile