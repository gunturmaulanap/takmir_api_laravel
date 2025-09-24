#!/bin/bash

# Manual Migration Script untuk Railway
echo "🚀 Starting Railway Database Migration and Seeding..."

# Set environment for Railway
export APP_ENV=production
export DB_CONNECTION=mysql

echo "1. Clearing caches..."
php artisan config:clear --no-interaction
php artisan cache:clear --no-interaction
php artisan route:clear --no-interaction

echo "2. Running fresh migration with seeding..."
php artisan migrate:fresh --seed --force --no-interaction

echo "3. Creating storage link..."
php artisan storage:link --force

echo "4. Optimizing for production..."
php artisan config:cache --no-interaction
php artisan route:cache --no-interaction
php artisan view:cache --no-interaction

echo "✅ Migration and seeding completed!"

echo "📋 Checking database tables..."
php artisan tinker --execute="echo 'Tables: ' . implode(', ', \DB::connection()->getSchemaBuilder()->getTableListing());"

echo "👤 Checking users..."
php artisan tinker --execute="echo 'Users count: ' . \App\Models\User::count();"