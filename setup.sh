#!/bin/bash

# School Vehicle Management System Setup Script
# This script automates the installation and setup process

echo "🚌 School Vehicle Management System Setup"
echo "=========================================="
echo ""

# Check if PHP is installed
if ! command -v php &> /dev/null; then
    echo "❌ PHP is not installed. Please install PHP 8.1 or higher."
    exit 1
fi

# Check PHP version
PHP_VERSION=$(php -r "echo PHP_VERSION;")
echo "✅ PHP version: $PHP_VERSION"

# Check if Composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer is not installed. Please install Composer."
    exit 1
fi

echo "✅ Composer is installed"

# Check if Node.js is installed
if ! command -v node &> /dev/null; then
    echo "❌ Node.js is not installed. Please install Node.js 16.x or higher."
    exit 1
fi

# Check Node.js version
NODE_VERSION=$(node -v)
echo "✅ Node.js version: $NODE_VERSION"

# Check if NPM is installed
if ! command -v npm &> /dev/null; then
    echo "❌ NPM is not installed. Please install NPM."
    exit 1
fi

echo "✅ NPM is installed"
echo ""

# Step 1: Install PHP dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader
if [ $? -eq 0 ]; then
    echo "✅ PHP dependencies installed successfully"
else
    echo "❌ Failed to install PHP dependencies"
    exit 1
fi

# Step 2: Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
npm install
if [ $? -eq 0 ]; then
    echo "✅ Node.js dependencies installed successfully"
else
    echo "❌ Failed to install Node.js dependencies"
    exit 1
fi

# Step 3: Environment setup
echo "⚙️ Setting up environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ Environment file created"
else
    echo "⚠️ Environment file already exists"
fi

# Step 4: Generate application key
echo "🔑 Generating application key..."
php artisan key:generate
if [ $? -eq 0 ]; then
    echo "✅ Application key generated"
else
    echo "❌ Failed to generate application key"
    exit 1
fi

# Step 5: Database setup
echo "🗄️ Setting up database..."
echo "Please make sure your database is configured in .env file"
echo "Press Enter to continue after configuring database..."
read

# Run migrations
php artisan migrate
if [ $? -eq 0 ]; then
    echo "✅ Database migrations completed"
else
    echo "❌ Failed to run database migrations"
    echo "Please check your database configuration in .env file"
    exit 1
fi

# Step 6: Seed database
echo "🌱 Seeding database with sample data..."
php artisan db:seed
if [ $? -eq 0 ]; then
    echo "✅ Database seeded successfully"
else
    echo "❌ Failed to seed database"
    exit 1
fi

# Step 7: Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link
if [ $? -eq 0 ]; then
    echo "✅ Storage link created"
else
    echo "❌ Failed to create storage link"
    exit 1
fi

# Step 8: Build assets
echo "🏗️ Building assets..."
npm run build
if [ $? -eq 0 ]; then
    echo "✅ Assets built successfully"
else
    echo "❌ Failed to build assets"
    exit 1
fi

# Step 9: Set permissions
echo "🔐 Setting file permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
echo "✅ File permissions set"

# Step 10: Clear caches
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "✅ Caches cleared"

# Step 11: Run performance optimization
echo "🚀 Running performance optimization..."
php artisan performance:monitor --optimize
if [ $? -eq 0 ]; then
    echo "✅ Performance optimization completed"
else
    echo "⚠️ Performance optimization had issues (this is optional)"
fi

echo ""
echo "🎉 Setup completed successfully!"
echo ""
echo "📋 Next Steps:"
echo "1. Configure your web server to point to the public directory"
echo "2. Set up SSL certificate for production"
echo "3. Configure email settings in .env file"
echo "4. Set up Redis for better performance (optional)"
echo ""
echo "🚀 Start the development server:"
echo "php artisan serve"
echo ""
echo "🌐 Access the application:"
echo "Admin Panel: http://localhost:8000/admin"
echo "Guardian Portal: http://localhost:8000/guardian"
echo "Driver Portal: http://localhost:8000/driver"
echo ""
echo "📚 Default Credentials:"
echo "Admin: admin@school.com / password"
echo "Guardian: guardian@school.com / password"
echo "Driver: driver@school.com / password"
echo ""
echo "📖 Documentation: README.md"
echo "🔧 Performance Guide: PERFORMANCE_OPTIMIZATION.md"
echo ""
echo "Happy coding! 🚌✨"
