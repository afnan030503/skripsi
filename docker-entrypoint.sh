#!/bin/sh
set -e

# Sesuaikan port Apache sesuai port dari Railway
PORT=${PORT:-80}
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Hapus cache lama agar ENV baru dari Railway terbaca
php artisan config:clear
php artisan cache:clear

# Lakukan caching ulang
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi jika DB sudah siap
php artisan migrate --force --no-interaction || true

exec "$@"
