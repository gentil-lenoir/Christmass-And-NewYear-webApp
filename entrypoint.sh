#!/bin/sh
set -e

# Créer .env si inexistant
if [ ! -f .env ]; then
    touch .env
fi

# Générer APP_KEY si vide
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Optimisation Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migration base de données
php artisan migrate --force

# Démarrer supervisord
exec supervisord -c /etc/supervisor/conf.d/supervisord.conf
