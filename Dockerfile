FROM php:8.2-cli

# Installer les extensions nécessaires
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /app

# Copier les fichiers Laravel
COPY . .

# Installer les dépendances
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Générer une clé d'app si elle n'existe pas
#RUN php artisan config:clear && php artisan key:generate

# Exposer le port que Railway attend
EXPOSE 8080

# Lancer Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
