@echo off
REM School Vehicle Management System Setup Script for Windows
REM This script automates the installation and setup process

echo 🚌 School Vehicle Management System Setup
echo ==========================================
echo.

REM Check if PHP is installed
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP is not installed. Please install PHP 8.1 or higher.
    pause
    exit /b 1
)

echo ✅ PHP is installed

REM Check if Composer is installed
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Composer is not installed. Please install Composer.
    pause
    exit /b 1
)

echo ✅ Composer is installed

REM Check if Node.js is installed
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Node.js is not installed. Please install Node.js 16.x or higher.
    pause
    exit /b 1
)

echo ✅ Node.js is installed

REM Check if NPM is installed
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ NPM is not installed. Please install NPM.
    pause
    exit /b 1
)

echo ✅ NPM is installed
echo.

REM Step 1: Install PHP dependencies
echo 📦 Installing PHP dependencies...
composer install --no-dev --optimize-autoloader
if %errorlevel% neq 0 (
    echo ❌ Failed to install PHP dependencies
    pause
    exit /b 1
)
echo ✅ PHP dependencies installed successfully

REM Step 2: Install Node.js dependencies
echo 📦 Installing Node.js dependencies...
npm install
if %errorlevel% neq 0 (
    echo ❌ Failed to install Node.js dependencies
    pause
    exit /b 1
)
echo ✅ Node.js dependencies installed successfully

REM Step 3: Environment setup
echo ⚙️ Setting up environment...
if not exist .env (
    copy .env.example .env
    echo ✅ Environment file created
) else (
    echo ⚠️ Environment file already exists
)

REM Step 4: Generate application key
echo 🔑 Generating application key...
php artisan key:generate
if %errorlevel% neq 0 (
    echo ❌ Failed to generate application key
    pause
    exit /b 1
)
echo ✅ Application key generated

REM Step 5: Database setup
echo 🗄️ Setting up database...
echo Please make sure your database is configured in .env file
echo Press any key to continue after configuring database...
pause >nul

REM Run migrations
php artisan migrate
if %errorlevel% neq 0 (
    echo ❌ Failed to run database migrations
    echo Please check your database configuration in .env file
    pause
    exit /b 1
)
echo ✅ Database migrations completed

REM Step 6: Seed database
echo 🌱 Seeding database with sample data...
php artisan db:seed
if %errorlevel% neq 0 (
    echo ❌ Failed to seed database
    pause
    exit /b 1
)
echo ✅ Database seeded successfully

REM Step 7: Create storage link
echo 🔗 Creating storage link...
php artisan storage:link
if %errorlevel% neq 0 (
    echo ❌ Failed to create storage link
    pause
    exit /b 1
)
echo ✅ Storage link created

REM Step 8: Build assets
echo 🏗️ Building assets...
npm run build
if %errorlevel% neq 0 (
    echo ❌ Failed to build assets
    pause
    exit /b 1
)
echo ✅ Assets built successfully

REM Step 9: Clear caches
echo 🧹 Clearing caches...
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo ✅ Caches cleared

REM Step 10: Run performance optimization
echo 🚀 Running performance optimization...
php artisan performance:monitor --optimize
if %errorlevel% neq 0 (
    echo ⚠️ Performance optimization had issues (this is optional)
) else (
    echo ✅ Performance optimization completed
)

echo.
echo 🎉 Setup completed successfully!
echo.
echo 📋 Next Steps:
echo 1. Configure your web server to point to the public directory
echo 2. Set up SSL certificate for production
echo 3. Configure email settings in .env file
echo 4. Set up Redis for better performance (optional)
echo.
echo 🚀 Start the development server:
echo php artisan serve
echo.
echo 🌐 Access the application:
echo Admin Panel: http://localhost:8000/admin
echo Guardian Portal: http://localhost:8000/guardian
echo Driver Portal: http://localhost:8000/driver
echo.
echo 📚 Default Credentials:
echo Admin: admin@school.com / password
echo Guardian: guardian@school.com / password
echo Driver: driver@school.com / password
echo.
echo 📖 Documentation: README.md
echo 🔧 Performance Guide: PERFORMANCE_OPTIMIZATION.md
echo.
echo Happy coding! 🚌✨
pause
