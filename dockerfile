# Menggunakan base image PHP 8.2 Apache yang stabil
FROM php:8.4-apache

# 1. Install dependensi sistem dan ekstensi PHP (GD untuk pasfoto, Zip, PDO MySQL)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libicu-dev \ 
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql intl

# 2. Aktifkan mod_rewrite untuk keamanan routing Laravel
RUN a2enmod rewrite

# 3. Set Working Directory
WORKDIR /var/www/html

# 4. Install Composer secara global
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Salin kode proyek dan atur izin akses
COPY . .

# 6. Install dependensi produksi & optimasi autoloader
RUN composer install --no-dev --optimize-autoloader

# 7. Pengaturan Izin Folder (Mencegah kerentanan akses file)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. Jalankan storage link agar berkas (CV/KTM) bisa diakses publik
RUN php artisan storage:link

# 9. Konfigurasi Apache Document Root ke folder public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80