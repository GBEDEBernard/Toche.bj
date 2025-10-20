FROM php:8.2-cli

# Installer dépendances système
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /app

# Copier le code Laravel
COPY . .

# Installer les dépendances PHP
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Préparer permissions Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# (Optionnel) Copier .env si non présent
COPY .env .env

# Générer la clé si non présente
RUN php artisan key:generate || true

# Exposer le port attendu par Railway
EXPOSE 8080

# Lancer Laravel (avec migration automatique si souhaité)
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080
