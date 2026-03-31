#!/bin/bash

# Default ke port 80 jika Railway tidak menetapkan port
PORT=${PORT:-80}

# Ubah settingan Apache agar menggunakan Port dari Railway
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Bersihkan cache dan jalankan migrasi database
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force

# Jalankan perintah utama Docker (seperti apache)
exec "$@"
