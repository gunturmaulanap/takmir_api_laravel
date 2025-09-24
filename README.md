# Setup Project Laravel

## Langkah Instalasi

1. Copy file environment:

    ```bash
    cp .env.example .env
    ```

2. Install dependency composer:

    ```bash
    composer install
    ```

3. Generate application key:

    ```bash
    php artisan key:generate
    ```

4. Jalankan migrasi database:

    ```bash
    php artisan migrate
    ```

5. (Opsional) Untuk reset dan seed ulang database:

    ```bash
    php artisan migrate:fresh --seed
    ```

6. Jalankan server lokal:
    ```bash
    php artisan serve
    ```

Pastikan sudah mengatur koneksi database di file `.env` sebelum menjalankan migrasi.

## Deployment ke Railway

Proyek ini sudah dikonfigurasi untuk deployment ke Railway dengan file `railway.json`. Untuk deploy:

1. Pastikan file `.env.production` sudah dikonfigurasi dengan benar
2. Railway akan secara otomatis menjalankan script deployment
3. Script deployment akan membersihkan cache dan membuat cache baru untuk konfigurasi dan route

Environment variables yang diperlukan di Railway:
- `DATABASE_HOST`
- `DATABASE_PORT`
- `DATABASE_NAME`
- `DATABASE_USER`
- `DATABASE_PASSWORD`
- `RAILWAY_STATIC_URL`

Script deployment akan secara otomatis:
1. Meng-copy `.env.example` ke `.env` jika belum ada
2. Generate application key jika belum ada
3. Membersihkan semua cache termasuk file cache di `bootstrap/cache/`
4. Membuat cache konfigurasi dan route

## Perbaikan Route Names
Perbaikan terakhir yang dilakukan untuk mengatasi error route caching:
- Admin category routes menggunakan nama prefix: `admin.categories.index`
- Superadmin category routes menggunakan nama prefix: `superadmin.categories.index`

Ini memastikan tidak ada duplikasi nama route yang menyebabkan error saat caching.
