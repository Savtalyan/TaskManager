#!/bin/bash
set -e

cd /var/www/TaskManager

# .env setup if missing
if [ ! -f ".env" ] && [ -f ".env.example" ]; then
  echo "🔐 Setting up environment file..."
  cp .env.example .env
fi

# Update .env database settings with environment variables
if [ ! -z "$DB_HOST" ]; then
  sed -i "s/^DB_HOST=.*/DB_HOST=$DB_HOST/" .env
fi
if [ ! -z "$DB_DATABASE" ]; then
  sed -i "s/^DB_DATABASE=.*/DB_DATABASE=$DB_DATABASE/" .env
fi
if [ ! -z "$DB_USERNAME" ]; then
  sed -i "s/^DB_USERNAME=.*/DB_USERNAME=$DB_USERNAME/" .env
fi
if [ ! -z "$DB_PASSWORD" ]; then
  sed -i "s/^DB_PASSWORD=.*/DB_PASSWORD=$DB_PASSWORD/" .env
fi

# Install dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node dependencies
echo "📦 Installing Node dependencies..."
npm install

# Build assets
echo "🔨 Building assets..."
npm run build

# Generate app key if missing or empty
if ! grep -q "^APP_KEY=" .env || grep -q "^APP_KEY=$" .env; then
  echo "🗝️  Generating app key..."
  php artisan key:generate
fi

# Fix permissions
echo "🔧 Fixing permissions..."
chown -R www-data:www-data /var/www/TaskManager/storage /var/www/TaskManager/bootstrap/cache
chmod -R 775 /var/www/TaskManager/storage /var/www/TaskManager/bootstrap/cache

# Wait for database
echo "Waiting for database to be reachable..."
while ! nc -z mysql 3306; do
  echo "Waiting for MySQL..."
  sleep 2
done

echo "Database is ready!"

# Clear config cache
php artisan config:clear

# Run migrations
echo "📂 Running migrations..."
php artisan migrate --force || true

# Create admin user if not exists
echo "👤 Creating admin user..."
php artisan tinker --execute="
if (!\App\Models\User::where('email', 'admin@admin.com')->exists()) {
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password'),
        'email_verified_at' => now(),
    ]);
    echo 'Admin user created successfully!';
} else {
    echo 'Admin user already exists.';
}
"

# Seed database

echo "✅ Laravel is ready. Starting PHP-FPM..."

exec php-fpm
