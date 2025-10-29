#!/bin/bash
set -e

echo "⏳ Waiting for MySQL at $DB_HOST:$DB_PORT..."
while ! nc -z "$DB_HOST" "$DB_PORT"; do
  sleep 1
done

echo "✅ MySQL is up, running migrations..."
php artisan migrate --force
php artisan db:seed --force

echo "🚀 Starting Laravel server"
exec php artisan serve --host=0.0.0.0 --port=8080
