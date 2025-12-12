# 6. Créez le Dockerfile
cat > Dockerfile << 'EOF'
FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

COPY . .

RUN chmod -R 775 storage bootstrap/cache

RUN echo 'events {}' > /etc/nginx/nginx.conf
RUN echo 'http {' >> /etc/nginx/nginx.conf
RUN echo '    server {' >> /etc/nginx/nginx.conf
RUN echo '        listen 8080;' >> /etc/nginx/nginx.conf
RUN echo '        root /var/www/public;' >> /etc/nginx/nginx.conf
RUN echo '        index index.php;' >> /etc/nginx/nginx.conf
RUN echo '        location / {' >> /etc/nginx/nginx.conf
RUN echo '            try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/nginx.conf
RUN echo '        }' >> /etc/nginx/nginx.conf
RUN echo '        location ~ \.php$ {' >> /etc/nginx/nginx.conf
RUN echo '            fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/nginx.conf
RUN echo '            include fastcgi_params;' >> /etc/nginx/nginx.conf
RUN echo '        }' >> /etc/nginx/nginx.conf
RUN echo '    }' >> /etc/nginx/nginx.conf
RUN echo '}' >> /etc/nginx/nginx.conf

EXPOSE 8080

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
EOF