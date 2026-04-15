#!/bin/bash
set -e

# Corriger les permissions pour les dossiers partagés via volumes
# Cela garantit que www-data peut toujours écrire, même si les permissions VPS changent

if [ -d "/var/www/html/Assets/data" ]; then
    chown -R www-data:www-data /var/www/html/Assets/data
    chmod -R 775 /var/www/html/Assets/data
fi

if [ -d "/var/www/html/logs" ]; then
    chown -R www-data:www-data /var/www/html/logs
    chmod -R 775 /var/www/html/logs
fi

# Lancer Apache
exec apache2-foreground
