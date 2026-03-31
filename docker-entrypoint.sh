#!/bin/sh

# Default ke port 80 jika Railway tidak menetapkan port
PORT=${PORT:-80}

# Ubah settingan Apache agar menggunakan Port dari Railway
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Hapus cache lama (penting agar env dari Railway terbaca segar)
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Cache ulang pakai konfigurasi env Railway
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan MIGRASI (dengan membatalkan error jika DB Railway belum siap)
php artisan migrate --force || true

# Jalankan perintah utama Docker (seperti apache2-foreground)
exec "$@"