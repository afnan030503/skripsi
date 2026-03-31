#!/bin/sh

a2dismod mpm_event || true
a2dismod mpm_worker || true
a2enmod mpm_prefork || true

PORT=${PORT:-80}
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

php artisan config:clear
php artisan cache:clear || true
php artisan route:clear
php artisan view:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache

php artisan storage:link || true

sleep 10

php artisan migrate --force || true

exec "$@"