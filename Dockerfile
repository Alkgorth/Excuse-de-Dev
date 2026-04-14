FROM php:8.3.14-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html

RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

# Corriger les permissions pour que www-data puisse écrire dans les répertoires
RUN mkdir -p /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html/Assets/data \
    && chmod -R 775 /var/www/html/Assets/data \
    && chown -R www-data:www-data /var/www/html/logs \
    && chmod -R 775 /var/www/html/logs

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
