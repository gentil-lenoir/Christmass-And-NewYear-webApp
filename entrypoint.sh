#!/bin/sh
set -e

# Attendre FPM socket
php-fpm -D

# Lancer Nginx
nginx -g "daemon off;"
