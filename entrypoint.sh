#!/bin/sh

# Lancer PHP-FPM en arrière-plan
php-fpm &

# Lancer Nginx au premier plan
nginx -g "daemon off;"
