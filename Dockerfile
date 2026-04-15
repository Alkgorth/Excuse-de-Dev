FROM php:8.3.14-apache

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install pdo pdo_mysql

RUN a2enmod rewrite

COPY . /var/www/html

RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

# Copier le script d'entrypoint
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Créer les dossiers et définir les permissions initiales
RUN mkdir -p /var/www/html/logs \
    && chown -R www-data:www-data /var/www/html/Assets/data \
    && chmod -R 775 /var/www/html/Assets/data \
    && chown -R www-data:www-data /var/www/html/logs \
    && chmod -R 775 /var/www/html/logs

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Utiliser le script d'entrypoint au démarrage du conteneur
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
