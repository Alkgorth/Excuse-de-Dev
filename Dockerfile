FROM php:8.3.14-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html

RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
