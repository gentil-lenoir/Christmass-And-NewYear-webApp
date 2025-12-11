FROM php:8.2-fpm-alpine

# Installations
RUN apk add --no-cache nginx
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www/html

# Copier application
COPY . .

# Configuration Nginx ligne par ligne (pas de heredoc)
RUN echo 'events {' > /etc/nginx/nginx.conf
RUN echo '    worker_connections 1024;' >> /etc/nginx/nginx.conf
RUN echo '}' >> /etc/nginx/nginx.conf
RUN echo 'http {' >> /etc/nginx/nginx.conf
RUN echo '    server {' >> /etc/nginx/nginx.conf
RUN echo '        listen 80;' >> /etc/nginx/nginx.conf
RUN echo '        root /var/www/html/public;' >> /etc/nginx/nginx.conf
RUN echo '        index index.php;' >> /etc/nginx/nginx.conf
RUN echo '        location / {' >> /etc/nginx/nginx.conf
RUN echo '            try_files $uri $uri/ /index.php?$query_string;' >> /etc/nginx/nginx.conf
RUN echo '        }' >> /etc/nginx/nginx.conf
RUN echo '        location ~ \.php$ {' >> /etc/nginx/nginx.conf
RUN echo '            fastcgi_pass 127.0.0.1:9000;' >> /etc/nginx/nginx.conf
RUN echo '            include fastcgi_params;' >> /etc/nginx/nginx.conf
RUN echo '            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;' >> /etc/nginx/nginx.conf
RUN echo '        }' >> /etc/nginx/nginx.conf
RUN echo '    }' >> /etc/nginx/nginx.conf
RUN echo '}' >> /etc/nginx/nginx.conf

EXPOSE 80
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]