#!/bin/bash

# Générer la clé d'application si elle n'existe pas
if [ -z "$(grep APP_KEY=base64 .env)" ]; then
    php artisan key:generate --force
fi

# Optimiser l'application
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migration de la base de données (si nécessaire)
php artisan migrate --force