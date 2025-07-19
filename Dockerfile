FROM php:8.3.14-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
