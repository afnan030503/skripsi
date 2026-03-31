#!/bin/sh
set -e

# 🔥 Langkah 1: Migrasi Database (Loker aman)
php artisan migrate --force --no-interaction || true

# 🔥 Langkah 2: Caching Laravel dengan ENV Railway terbaru
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# 🔥 Langkah 3: Pastikan izin folder sekali lagi di runtime
chown -R www-data:www-data storage bootstrap/cache || true

exec "$@"
