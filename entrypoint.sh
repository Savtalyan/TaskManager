#!/bin/bash
set -e

cd /var/www/TaskManager

# .env setup if missing
if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  echo "🔐 Setting up environment file..."
  cp .env.example .env

  # Update .env database settings with environment variables
  sed -i "s/^DB_HOST=.*/DB_HOST=$DB_HOST/" .env
  sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
  sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
  sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env
fi

# Generate app key if missing or empty
if ! grep -q "^APP_KEY=" .env || grep -q "^APP_KEY=$" .env; then
  echo "🗝️  Generating app key..."
  php artisan key:generate
fi

# Fix permissions
echo "🔧 Fixing permissions..."
chmod -R 775 storage bootstrap/cache || true

# Run migrations
echo "📂 Running migrations..."
php artisan migrate --force || true

# Seed DB

# Orchid setup
if [ ! -f "config/platform.php" ]; then
  echo "🧩 Installing Orchid platform..."
  php artisan orchid:install || true
fi

echo "✅ Laravel is ready. Starting PHP-FPM..."

exec php-fpm
