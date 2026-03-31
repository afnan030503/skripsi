FROM php:8.2-apache

# 1. Install sistem dependensi dan aplikasi dasar
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    npm \
    nodejs \
    dos2unix

# Bersihkan cache instalan untuk memperkecil ukuran image
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions yang dibutuhkan Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 3. Dapatkan file executable Composer terbaru
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 4. Atur direktori kerja utama di Docker
WORKDIR /var/www/html

# 5. Copy seluruh isi folder proyekmu ke dalam Docker
COPY . .

# 6. Atur konfigurasi Apache Server agar langsung membaca folder `/public` Laravel
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Aktifkan mod_rewrite Apache untuk routing Laravel
RUN a2enmod rewrite

# 7. Install dan Build file React/Vue (Vite)
RUN npm install
RUN npm run build

# 8. Install module Laravel terbaru tanpa menghadirkan dev tools
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 9. Pindahkan hak akses file krusial ke server web (Apache/www-data)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Copy script pintu gerbang (docker-entrypoint.sh)
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
RUN dos2unix /usr/local/bin/docker-entrypoint.sh || true

# 11. Buka jalur HTTP
EXPOSE 80

# 12. Tentukan perintah eksekusi awal Docker
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
