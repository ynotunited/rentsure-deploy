#!/bin/bash

# RentSure Deployment Script
echo "🚀 Deploying RentSure..."

# Install dependencies
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader

# Clear and cache configurations
echo "⚡ Optimizing Laravel..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Seed test users
echo "👥 Creating test users..."
php artisan db:seed --class=TestUserSeeder

# Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "✅ RentSure deployment completed!"
echo ""
echo "🔑 Test Accounts:"
echo "Admin: admin@rentsure.com / admin123"
echo "Landlord: landlord@test.com / password"
echo "Agent: agent@test.com / password"
echo "Tenant: tenant@test.com / password"
echo ""
echo "📱 Your RentSure app is now live!"
