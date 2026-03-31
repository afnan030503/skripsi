#!/bin/sh
set -e

# Port adjustment
PORT=${PORT:-80}
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 1. Jalankan MIGRATION duluan! (Agar tabel terbuat dulu)
# Gunakan || true agar server tidak mati kalau koneksi DB sedang sibuk atau lama dimulainya.
php artisan migrate --force --no-interaction || true

# 2. Sekarang baru hapus cache. Kalau gagal (karena tabel belum ada), biarkan saja (|| true).
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true

# 3. Terakhir baru caching ulang agar ENV baru terbaca
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Hand over to CMD (apache2-foreground)
exec "$@"
