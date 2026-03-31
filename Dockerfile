FROM dunglas/frankenphp:latest-php8.2-bookworm

# Install sistem dependensi mendasar
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip npm nodejs dos2unix

# Install SEMUANYA modul PHP yang dibutuhkan Laravel
RUN install-php-extensions pdo_mysql gd bcmath zip intl opcache mbstring xml curl ctype

# COPY COMPOSER (Penting agar perintah composer install terbaca)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Set izin folder untuk Laravel agar bisa menulis log/cache
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

# Jalankan instalasi dependensi & build frontend
RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN npm install && npm run build

# Entrypoint setup
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
RUN dos2unix /usr/local/bin/docker-entrypoint.sh

# Environment FrankenPHP
ENV SERVER_NAME=:80
ENV FRANKENPHP_CONFIG="worker ./public/index.php"

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]
