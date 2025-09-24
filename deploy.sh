#!/bin/bash
# Script untuk deployment di Railway

# Copy environment file jika belum ada
if [ ! -f .env ]; then
    echo "Copying .env.example to .env"
    cp .env.example .env
fi

# Generate key jika belum ada
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "" ]; then
    echo "Generating application key"
    php artisan key:generate --force
fi

# Clear semua cache
echo "Clearing all caches"
rm -rf bootstrap/cache/*.php
php artisan optimize:clear

# Caching konfigurasi dan route
echo "Caching configuration and routes"
php artisan config:cache
php artisan route:cache

echo "Deployment setup completed"