FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx

WORKDIR /var/www/html
COPY . .

# Afficher la configuration Nginx générée
RUN echo "=== NGINX CONFIGURATION ===" && \
    cat > /etc/nginx/nginx.conf << 'EOF'
events {
    worker_connections 1024;
}

http {
    server {
        listen 80;
        root /var/www/html/public;
        index index.php;
        
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
        
        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            include fastcgi_params;
        }
    }
}
EOF

# Afficher le fichier de config
RUN cat /etc/nginx/nginx.conf

# Tester
RUN nginx -t

RUN mkdir -p public && echo 'OK' > public/index.html

EXPOSE 8080
CMD ["sh", "-c", "echo 'Starting...' && nginx -g 'daemon off;'"]