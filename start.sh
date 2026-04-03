#!/bin/bash

echo "Clearing & caching config..."

php artisan config:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migration..."
php artisan migrate --force

echo "Starting Apache..."
apache2-foreground