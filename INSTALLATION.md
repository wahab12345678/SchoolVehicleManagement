# 🚀 Installation Guide

This guide provides step-by-step instructions for installing the School Vehicle Management System.

## 📋 Prerequisites

### System Requirements
- **Operating System**: Windows 10+, macOS 10.15+, or Linux (Ubuntu 20.04+)
- **PHP**: 8.1 or higher
- **Composer**: Latest version
- **Node.js**: 16.x or higher
- **NPM**: 8.x or higher
- **Database**: MySQL 8.0+ or MariaDB 10.3+
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **Memory**: 2GB RAM minimum (4GB recommended)
- **Storage**: 1GB free space

### Required PHP Extensions
- BCMath
- Ctype
- cURL
- DOM
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- GD or Imagick

## 🚀 Quick Installation

### Option 1: Automated Setup (Recommended)

#### For Linux/macOS:
```bash
chmod +x setup.sh
./setup.sh
```

#### For Windows:
```cmd
setup.bat
```

### Option 2: Docker Installation
```bash
# Clone the repository
git clone https://github.com/your-username/school-vehicle-management.git
cd school-vehicle-management

# Start with Docker Compose
docker-compose up -d

# Run setup commands
docker-compose exec app composer install
docker-compose exec app npm install
docker-compose exec app cp .env.example .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan storage:link
docker-compose exec app npm run build
```

## 🔧 Manual Installation

### Step 1: Clone Repository
```bash
git clone https://github.com/your-username/school-vehicle-management.git
cd school-vehicle-management
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install Node.js Dependencies
```bash
npm install
```

### Step 4: Environment Configuration
```bash
cp .env.example .env
```

Edit `.env` file with your configuration:
```env
APP_NAME="School Vehicle Management"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_vehicle_management
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Step 5: Generate Application Key
```bash
php artisan key:generate
```

### Step 6: Database Setup
Create a MySQL database:
```sql
CREATE DATABASE school_vehicle_management;
```

Run migrations:
```bash
php artisan migrate
```

### Step 7: Seed Database
```bash
php artisan db:seed
```

### Step 8: Create Storage Link
```bash
php artisan storage:link
```

### Step 9: Build Assets
```bash
npm run build
```

### Step 10: Set Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Step 11: Clear Caches
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

## 🌐 Web Server Configuration

### Apache Configuration
Create a virtual host configuration:

```apache
<VirtualHost *:80>
    ServerName school-vehicle.local
    DocumentRoot /path/to/school-vehicle-management/public
    
    <Directory /path/to/school-vehicle-management/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/school-vehicle_error.log
    CustomLog ${APACHE_LOG_DIR}/school-vehicle_access.log combined
</VirtualHost>
```

### Nginx Configuration
```nginx
server {
    listen 80;
    server_name school-vehicle.local;
    root /path/to/school-vehicle-management/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## 🐳 Docker Installation

### Prerequisites
- Docker
- Docker Compose

### Setup
1. Clone the repository
2. Copy environment file:
   ```bash
   cp .env.example .env
   ```
3. Start containers:
   ```bash
   docker-compose up -d
   ```
4. Run setup commands:
   ```bash
   docker-compose exec app composer install
   docker-compose exec app npm install
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   docker-compose exec app php artisan db:seed
   docker-compose exec app php artisan storage:link
   docker-compose exec app npm run build
   ```

### Access Points
- **Application**: http://localhost
- **phpMyAdmin**: http://localhost:8080
- **Database**: localhost:3306
- **Redis**: localhost:6379

## 🚀 Performance Optimization

### Redis Setup (Optional)
Install Redis for better caching:
```bash
# Ubuntu/Debian
sudo apt-get install redis-server

# macOS
brew install redis

# Windows
# Download from https://github.com/microsoftarchive/redis/releases
```

Configure in `.env`:
```env
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Database Optimization
```bash
# Run performance optimization
php artisan performance:monitor --optimize

# Clear caches
php artisan performance:monitor --clear-cache
```

## 🔧 Development Setup

### Development Server
```bash
php artisan serve
```

### Asset Compilation
```bash
# Development with hot reload
npm run dev

# Production build
npm run build
```

### Code Quality
```bash
# Check code style
./vendor/bin/phpcs

# Fix code style issues
./vendor/bin/phpcbf
```

## 🧪 Testing

### Run Tests
```bash
php artisan test
```

### Database Testing
```bash
# Refresh database for testing
php artisan migrate:fresh --seed
```

## 🔒 Security Configuration

### Production Environment
```env
APP_ENV=production
APP_DEBUG=false
LOG_LEVEL=error
```

### SSL Configuration
1. Obtain SSL certificate
2. Configure web server for HTTPS
3. Update APP_URL to use HTTPS

### File Permissions
```bash
# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

## 📊 Monitoring Setup

### Performance Monitoring
```bash
# Enable performance monitoring
php artisan performance:monitor --metrics

# Check system health
php artisan performance:test --all
```

### Log Configuration
```env
LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
```

## 🚨 Troubleshooting

### Common Issues

#### 1. Permission Errors
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 755 storage bootstrap/cache
```

#### 2. Database Connection Issues
- Check database credentials in `.env`
- Ensure database server is running
- Verify database exists

#### 3. Cache Issues
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### 4. Asset Issues
```bash
npm run build
php artisan storage:link
```

#### 5. Performance Issues
```bash
php artisan performance:monitor --optimize
php artisan performance:monitor --clear-cache
```

### Debug Mode
Enable debug mode for development:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

### Log Files
Check log files for errors:
```bash
tail -f storage/logs/laravel.log
```

## 📋 Post-Installation Checklist

- [ ] Application loads without errors
- [ ] Database migrations completed
- [ ] Sample data seeded
- [ ] Storage link created
- [ ] Assets built successfully
- [ ] Caches cleared
- [ ] Performance optimization run
- [ ] SSL certificate configured (production)
- [ ] Email configuration tested
- [ ] Backup strategy implemented

## 🎉 Success!

Your School Vehicle Management System is now installed and ready to use!

### Access Points
- **Admin Panel**: http://localhost:8000/admin
- **Guardian Portal**: http://localhost:8000/guardian
- **Driver Portal**: http://localhost:8000/driver

### Default Credentials
- **Admin**: admin@school.com / password
- **Guardian**: guardian@school.com / password
- **Driver**: driver@school.com / password

### Next Steps
1. Configure email settings
2. Set up SSL certificate for production
3. Configure Redis for better performance
4. Set up automated backups
5. Configure monitoring and alerts

## 📞 Support

If you encounter any issues during installation:
1. Check the troubleshooting section
2. Review the log files
3. Check GitHub issues
4. Contact support for enterprise features

---

**Happy coding! 🚌✨**
