#!/bin/sh
set -e

# Sesuaikan port Apache sesuai port dari Railway
PORT=${PORT:-80}
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 1. Jalankan MIGRATION Database
php artisan migrate --force --no-interaction || true

# 2. Caching Laravel agar ENV terbaru Railway terbaca
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

exec "$@"
