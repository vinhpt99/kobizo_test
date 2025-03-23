# Sử dụng PHP 8.2 FPM
FROM php:8.2-fpm

# Cài đặt dependencies cho PHP
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libonig-dev \
    && docker-php-ext-install pdo pdo_mysql

# Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc
WORKDIR /var/www/html
