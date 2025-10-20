FROM php:8.2-cli

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /app

# Copier tout le code source Laravel dans le conteneur
COPY . .

# Installer les dépendances PHP de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Préparer les permissions pour Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Générer une clé d'application si elle n'existe pas
RUN php artisan key:generate || true

# Exposer le port attendu par Railway
EXPOSE 8080

# Lancer Laravel (avec migrations et seeders automatiques)
CMD php artisan migrate --force --seed && php artisan serve --host=0.0.0.0 --port=8080
