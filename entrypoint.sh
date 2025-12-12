#!/bin/sh
set -e

# Démarrer PHP-FPM en arrière-plan
php-fpm &

# Attendre que PHP-FPM soit prêt (simple sleep)
sleep 3

# Démarrer Nginx en premier plan
nginx -g "daemon off;"
