#!/bin/bash
set -e

# Pergi ke working directory
cd /var/www/html

# Jalankan Composer jika vendor belum terinstal
if [ ! -d "vendor" ]; then
    echo "Instalasi dependensi Composer..."
    composer install --optimize-autoloader
else
    echo "Dependensi Composer sudah terinstal, skip instalasi."
fi

# Menjalankan perintah artisan yang diperlukan
echo "Menjalankan migrasi dan seeder..."
php artisan migrate:fresh --seed --force

echo "Membersihkan cache..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Jalankan perintah utama agar kontainer tetap hidup
exec "$@"