#!/bin/bash

# Carmasy Production Deployment Script
# Optimizes Laravel 12 + Livewire v4 + Tailwind v4 for production

set -e

echo "🚀 Starting Carmasy production deployment..."

# Environment setup
echo "📝 Setting up environment..."
cp .env.production .env
php artisan key:generate --force

# Clear all caches
echo "🧹 Clearing development caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear

# Install production dependencies
echo "📦 Installing production dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction
npm ci --production

# Build optimized assets
echo "🎨 Building optimized assets..."
npm run build

# Optimize Laravel for production
echo "⚡ Optimizing Laravel for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Run database migrations (if needed)
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Storage optimization
echo "💾 Setting up storage optimization..."
php artisan storage:link
php artisan optimize

# Livewire optimizations
echo "🔄 Optimizing Livewire components..."
php artisan livewire:publish --assets

# Set proper file permissions
echo "🔒 Setting file permissions..."
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Generate production manifest
echo "📋 Generating production manifest..."
php artisan optimize:clear
php artisan optimize

echo "✅ Production deployment completed successfully!"
echo ""
echo "📊 Deployment Summary:"
echo "   ├── Laravel: $(php artisan --version | cut -d' ' -f3)"
echo "   ├── Environment: $(grep APP_ENV .env | cut -d'=' -f2)"
echo "   ├── Debug Mode: $(grep APP_DEBUG .env | cut -d'=' -f2)"
echo "   ├── Cache Driver: $(grep CACHE_STORE .env | cut -d'=' -f2)"
echo "   └── Session Driver: $(grep SESSION_DRIVER .env | cut -d'=' -f2)"
echo ""
echo "🌐 Your Carmasy application is ready for production!"
echo "   Visit: $(grep APP_URL .env | cut -d'=' -f2)"