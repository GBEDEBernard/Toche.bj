# Utiliser l’image officielle PHP avec les extensions nécessaires à Laravel
FROM php:8.3-fpm

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev zip curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installer Composer (gestionnaire de dépendances PHP)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Créer le dossier de l’app
WORKDIR /var/www

# Copier les fichiers du projet dans le conteneur
COPY . .

# Installer les dépendances Laravel
RUN composer install --optimize-autoloader --no-dev

# Donner les bonnes permissions à Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Exposer le port sur lequel Laravel va tourner
EXPOSE 8080

# Démarrer le serveur Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
