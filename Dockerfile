FROM php:8.3.14-apache

RUN apt-get update

COPY . .

COPY --from=composer:latest /usr/bin/composer usr/local/bin/composer
