FROM php:8.2-apache

# --------------------------
# 1. INSTALASI DEPENDENSI
# --------------------------
# Memasang dependensi sistem dan ekstensi PHP yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y --no-install-recommends \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd \
    # Bersihkan cache apt-get untuk mengurangi ukuran image
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# --------------------------
# 2. KOMPOSER
# --------------------------
# Menyalin Composer dari image resmi
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# --------------------------
# 3. KONFIGURASI APACHE (Fix 404 Not Found)
# --------------------------
# Aktifkan modul rewrite (penting untuk routing Laravel)
RUN a2enmod rewrite

# Hapus konfigurasi default Apache
RUN rm /etc/apache2/sites-enabled/000-default.conf

# Tambahkan konfigurasi host virtual (VHost) kustom untuk Laravel
# Ini mengarahkan DocumentRoot ke folder 'public'
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html/public\n\
    <Directory /var/www/html/public>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog /var/log/apache2/error.log\n\
    CustomLog /var/log/apache2/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/laravel.conf

# Aktifkan konfigurasi baru tersebut
RUN a2ensite laravel.conf

# --------------------------
# 4. ENTRYPOINT DAN WORKDIR
# --------------------------
# Salin entrypoint script (init.sh)
COPY docker/php/init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

# Menetapkan working directory di dalam kontainer
WORKDIR /var/www/html

# Tentukan entrypoint (script yang dijalankan sebelum memulai CMD)
ENTRYPOINT ["/usr/local/bin/init.sh"]

# Tentukan CMD (perintah utama yang menjaga kontainer tetap berjalan)
CMD ["apache2-foreground"]
