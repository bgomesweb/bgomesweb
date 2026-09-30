#!/bin/sh
set -e

cd /var/www/html

if [ ! -d vendor ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
fi

if [ ! -f .env ]; then
    cp .env.example .env
fi

if ! grep -q '^APP_KEY=base64' .env; then
    php artisan key:generate --force --ansi
fi

echo "Waiting for database at ${DB_HOST:-mariadb}:${DB_PORT:-3306}..."
until nc -z "${DB_HOST:-mariadb}" "${DB_PORT:-3306}"; do
    sleep 2
done
echo "Database is up."

php artisan migrate --force
php artisan db:seed --force
php artisan storage:link || true
php artisan config:cache
php artisan route:cache

chmod -R 777 storage/framework storage/logs bootstrap/cache

exec "$@"
