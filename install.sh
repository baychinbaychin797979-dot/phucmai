#!/bin/bash

# Movable Type Framework Installation Script

set -e

echo "🚀 Movable Type Framework Installation"
echo "========================================"

# Check PHP version
echo "✓ Checking PHP version..."
php -v

# Check MySQL
echo "✓ Checking MySQL..."
mysql --version || echo "⚠ MySQL not installed"

# Install Composer dependencies
echo "✓ Installing Composer dependencies..."
composer install

# Install NPM dependencies
echo "✓ Installing NPM dependencies..."
npm install

# Create .env file
if [ ! -f .env ]; then
    echo "✓ Creating .env file..."
    cp .env.example .env
    echo "⚠ Please edit .env with your configuration"
fi

# Create storage directories
echo "✓ Creating storage directories..."
mkdir -p storage/cache
mkdir -p storage/logs
mkdir -p storage/uploads
chmod -R 755 storage

# Run migrations
echo "✓ Running database migrations..."
php artisan migrate || echo "⚠ Database migration failed"

# Seed database
echo "✓ Seeding database..."
php artisan db:seed || echo "⚠ Database seeding failed"

echo ""
echo "✓ Installation completed!"
echo "✓ Start server with: npm run dev"
