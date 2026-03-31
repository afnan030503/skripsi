#!/bin/sh
set -e

# Sesuaikan port Apache sesuai port dari Railway
PORT=${PORT:-80}
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Hapus cache lama (agar ENV segar terbaca dari Railway)
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Lakukan caching ulang pakai ENV Railway yang baru
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Jalankan migrasi database
php artisan migrate --force --no-interaction || true

exec "$@"
