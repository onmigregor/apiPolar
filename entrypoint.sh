#!/bin/bash

# Exit on error
set -e

# Run composer install if the vendor directory doesn't exist
# This allows the container to start quickly if dependencies are already installed
if [ ! -d "vendor" ] || [ ! -f "vendor/autoload.php" ]; then
    echo "Dependencies not found. Running composer install..."
    composer install --no-interaction --prefer-dist --optimize-autoloader
else
    echo "Dependencies found. Skipping composer install."
fi


# Run database migrations
# We use --force to run them in production without prompts
echo "Running migrations..."
php artisan migrate --force

# Clear and cache configurations for optimal performance
echo "Caching configurations..."
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Execute the original CMD from the Dockerfile
echo "Starting Apache..."
exec "$@"
