FROM php:8.2-fpm-alpine

RUN apk add --no-cache nginx curl
RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www

# 1. Copier l'application
COPY . .

# 2. CRÉER ABSOLUMENT les fichiers nécessaires
RUN mkdir -p /var/www/public
RUN echo '<?php phpinfo(); ?>' > /var/www/public/index.php
RUN echo '<?php echo "test.php works"; ?>' > /var/www/public/test.php
RUN echo '<!DOCTYPE html><html><head><title>Laravel</title></head><body><h1>HTML Page</h1></body></html>' > /var/www/public/index.html

# 3. Configuration Nginx ULTRA SIMPLE mais CORRECTE
RUN cat > /etc/nginx/nginx.conf << 'EOF'
events {
    worker_connections 1024;
}

http {
    server {
        listen 8080;
        server_name _;
        root /var/www/public;
        
        # Servir les fichiers statiques
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
        
        # PHP files
        location ~ \.php$ {
            fastcgi_pass 127.0.0.1:9000;
            fastcgi_index index.php;
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        }
    }
}
EOF

# 4. VÉRIFIER que tout est correct
RUN echo "=== VÉRIFICATION FINALE ===" && \
    echo "1. Fichier index.php existe?" && \
    ls -la /var/www/public/index.php && \
    echo "" && \
    echo "2. Contenu de index.php:" && \
    cat /var/www/public/index.php && \
    echo "" && \
    echo "3. Configuration Nginx:" && \
    cat /etc/nginx/nginx.conf | head -20 && \
    echo "" && \
    echo "4. Test syntaxe Nginx:" && \
    nginx -t

# 5. Script de démarrage avec logs
RUN cat > /start.sh << 'EOF'
#!/bin/sh
set -e

echo "=== DÉMARRAGE ==="
echo "1. Démarrer PHP-FPM..."
php-fpm -D
sleep 2

echo "2. Vérifier PHP-FPM..."
if pgrep php-fpm > /dev/null; then
    echo "✅ PHP-FPM en cours"
else
    echo "❌ PHP-FPM échoué"
    exit 1
fi

echo "3. Tester Nginx config..."
nginx -t

echo "4. Lancer Nginx..."
echo "✅ Service prêt sur le port 8080"
exec nginx -g 'daemon off;'
EOF

RUN chmod +x /start.sh

EXPOSE 8080

# 6. Health check pour RNDR
HEALTHCHECK --interval=30s --timeout=3s --start-period=10s --retries=3 \
    CMD curl -f http://localhost:8080/ || exit 1

CMD ["/start.sh"]