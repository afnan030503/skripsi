#!/bin/sh

PORT=${PORT:-80}

sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 🔥 WAJIB: hapus cache lama dulu
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 🔥 baru cache ulang
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 🔥 jalankan migrate (jangan bikin container mati kalau gagal)
php artisan migrate --force || true

exec "$@"