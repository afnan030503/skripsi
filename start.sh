#!/bin/bash

# Configuration caching
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (only safe if you want it to run on every deploy, uncomment if needed)
php artisan migrate --force

# Start Apache in foreground
echo "Starting Apache..."
apache2-foreground
