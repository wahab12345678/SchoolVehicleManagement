# ⚡ Quick Start Guide

Get your School Vehicle Management System up and running in minutes!

## 🚀 5-Minute Setup

### Prerequisites Check
```bash
# Check PHP version (8.1+ required)
php --version

# Check Composer
composer --version

# Check Node.js (16+ required)
node --version

# Check NPM
npm --version
```

### Automated Installation

#### Linux/macOS:
```bash
chmod +x setup.sh
./setup.sh
```

#### Windows:
```cmd
setup.bat
```

#### Docker:
```bash
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app npm install
docker-compose exec app cp .env.example .env
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
docker-compose exec app php artisan storage:link
docker-compose exec app npm run build
```

## 🌐 Access Your Application

### Start Development Server
```bash
php artisan serve
```

### Access Points
- **Admin Panel**: http://localhost:8000/admin
- **Guardian Portal**: http://localhost:8000/guardian  
- **Driver Portal**: http://localhost:8000/driver

### Default Login Credentials
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@school.com | password |
| Guardian | guardian@school.com | password |
| Driver | driver@school.com | password |

## 🎯 Key Features to Try

### 1. Dashboard
- View comprehensive statistics
- Monitor real-time data
- Access quick actions

### 2. Student Management
- Add new students
- Assign guardians
- Set pickup/dropoff locations
- Track transportation history

### 3. Vehicle Management
- Register vehicles
- Assign drivers
- Monitor availability
- Track performance

### 4. Trip Management
- Create new trips
- Assign students to trips
- Track trip progress
- Update trip status

### 5. Real-time Tracking
- Monitor active trips
- Track vehicle locations
- Send notifications
- Update status

## 🔧 Quick Configuration

### Database Configuration
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_vehicle_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Email Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
```

### Performance Optimization
```bash
# Run performance optimization
php artisan performance:monitor --optimize

# Clear caches
php artisan performance:monitor --clear-cache
```

## 🚨 Common Issues & Solutions

### Issue: Database Connection Error
**Solution**: Check database credentials in `.env` file
```bash
php artisan config:clear
```

### Issue: Permission Denied
**Solution**: Set proper file permissions
```bash
chmod -R 755 storage bootstrap/cache
```

### Issue: Assets Not Loading
**Solution**: Build assets and create storage link
```bash
npm run build
php artisan storage:link
```

### Issue: Slow Performance
**Solution**: Run performance optimization
```bash
php artisan performance:monitor --optimize
```

## 📊 Performance Commands

```bash
# Test system performance
php artisan performance:test --all

# Monitor performance metrics
php artisan performance:monitor --metrics

# Clear all caches
php artisan performance:monitor --clear-cache

# Optimize database
php artisan performance:monitor --optimize
```

## 🎉 You're Ready!

Your School Vehicle Management System is now running with:
- ✅ Complete student management
- ✅ Real-time tracking capabilities
- ✅ Performance optimizations
- ✅ Responsive design
- ✅ Role-based access control

## 📚 Next Steps

1. **Customize**: Update school information and branding
2. **Configure**: Set up email notifications
3. **Optimize**: Configure Redis for better performance
4. **Deploy**: Set up production environment
5. **Monitor**: Set up performance monitoring

## 📖 Documentation

- **Full Installation**: [INSTALLATION.md](INSTALLATION.md)
- **Performance Guide**: [PERFORMANCE_OPTIMIZATION.md](PERFORMANCE_OPTIMIZATION.md)
- **Complete Documentation**: [README.md](README.md)

## 🆘 Need Help?

- Check the troubleshooting section
- Review log files: `storage/logs/laravel.log`
- Run performance tests: `php artisan performance:test --all`
- Contact support for enterprise features

---

**Welcome to your School Vehicle Management System! 🚌✨**
