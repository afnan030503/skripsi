#!/bin/sh

# 🔥 FIX APACHE MPM (WAJIB)
a2dismod mpm_event || true
a2dismod mpm_worker || true
a2enmod mpm_prefork || true

PORT=${PORT:-80}
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# 🔥 CLEAR CACHE (biar env Railway kebaca)
php artisan config:clear
php artisan cache:clear || true
php artisan route:clear
php artisan view:clear

# 🔥 CACHE ULANG
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 🔥 STORAGE LINK
php artisan storage:link || true

# 🔥 MIGRATE (jangan bikin crash)
php artisan migrate --force || true

exec "$@"