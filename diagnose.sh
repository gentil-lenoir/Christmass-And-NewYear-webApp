#!/bin/bash

echo "=== 1. Vérifier la structure du projet ==="
ls -la

echo -e "\n=== 2. Vérifier composer.json ==="
if [ -f composer.json ]; then
    cat composer.json
else
    echo "ERROR: composer.json manquant!"
    exit 1
fi

echo -e "\n=== 3. Tester composer localement ==="
composer diagnose || echo "Composer non installé localement"

echo -e "\n=== 4. Tester Docker Build ==="
docker build --no-cache --progress=plain . 2>&1 | grep -A 10 -B 10 "composer install"