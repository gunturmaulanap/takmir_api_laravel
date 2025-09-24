#!/bin/bash

# Production Migration Script
echo "Running production migrations and setup..."

# Run database migrations
php artisan migrate --force

# Seed permissions and roles (if needed)
php artisan db:seed --class=RoleSeeder --force
php artisan db:seed --class=PermissionSeeder --force

# Generate JWT secret if not exists
if [ -z "$JWT_SECRET" ]; then
    php artisan jwt:secret --force
fi

# Generate app key if not exists  
if [ -z "$APP_KEY" ]; then
    php artisan key:generate --force
fi

# Create storage link
php artisan storage:link --force

# Cache optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Production setup completed!"