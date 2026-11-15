# 🚌 School Vehicle Management System

A comprehensive Laravel-based system for managing school transportation, tracking students, vehicles, drivers, and routes with real-time monitoring capabilities.

## 📋 Table of Contents

- [Features](#-features)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Database Setup](#-database-setup)
- [Usage](#-usage)
- [Performance Optimization](#-performance-optimization)
- [API Documentation](#-api-documentation)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

### 🎯 Core Features
- **Student Management**: Complete CRUD operations for student records
- **Guardian Tracking**: Real-time tracking of children's transportation
- **Vehicle Management**: Fleet management with driver assignments
- **Route Planning**: Optimized route management and planning
- **Trip Tracking**: Real-time trip monitoring and status updates
- **Driver Management**: Driver profiles and vehicle assignments
- **School Management**: Multi-school support with individual configurations

### 🚀 Advanced Features
- **Real-time Tracking**: Live GPS tracking of vehicles and students
- **Interactive Maps**: Leaflet.js integration for location picking
- **Dashboard Analytics**: Comprehensive statistics and trends
- **Role-based Access**: Admin, Guardian, and Driver roles
- **Performance Optimized**: High-performance caching and database optimization
- **Responsive Design**: Mobile-friendly interface
- **Data Export**: CSV export functionality
- **Bulk Operations**: Mass operations for efficiency

### 📊 Dashboard Features
- **Statistics Overview**: Key metrics and KPIs
- **Trend Analysis**: Performance trends and analytics
- **Real-time Updates**: Live data updates
- **Interactive Charts**: Visual data representation
- **Quick Actions**: Fast access to common operations

## 🔧 Requirements

### System Requirements
- **PHP**: 8.1 or higher
- **Composer**: Latest version
- **Node.js**: 16.x or higher
- **NPM**: 8.x or higher
- **Database**: MySQL 8.0+ or MariaDB 10.3+
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **Memory**: 2GB RAM minimum (4GB recommended)
- **Storage**: 1GB free space

### PHP Extensions
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
- Redis (optional, for caching)

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/your-username/school-vehicle-management.git
cd school-vehicle-management
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
cp .env.example .env
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Configure Database
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_vehicle_management
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 7. Run Database Migrations
```bash
php artisan migrate
```

### 8. Seed Database
```bash
php artisan db:seed
```

### 9. Create Storage Link
```bash
php artisan storage:link
```

### 10. Build Assets
```bash
npm run build
```

### 11. Start Development Server
```bash
php artisan serve
```

## ⚙️ Configuration

### Environment Variables

#### Database Configuration
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=school_vehicle_management
DB_USERNAME=root
DB_PASSWORD=
```

#### Cache Configuration (Optional - for better performance)
```env
CACHE_DRIVER=redis
CACHE_PREFIX=school_management
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

#### Mail Configuration
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### Performance Configuration
```env
# Performance Monitoring
PERFORMANCE_MONITORING_ENABLED=true
PERFORMANCE_SLOW_REQUEST_THRESHOLD=2000
PERFORMANCE_MEMORY_LIMIT_THRESHOLD=128

# Cache TTL Settings (in seconds)
CACHE_DASHBOARD_STATS_TTL=300
CACHE_RECENT_TRIPS_TTL=180
CACHE_ACTIVE_TRIPS_TTL=60
```

## 🗄️ Database Setup

### Database Schema
The system includes the following main tables:

- **users**: System users (admins, drivers)
- **guardians**: Parent/guardian information
- **students**: Student records with location data
- **vehicles**: Fleet management
- **drivers**: Driver profiles
- **routes**: Transportation routes
- **trips**: Trip records and tracking
- **trip_locations**: GPS tracking data
- **schools**: School information
- **contacts**: Contact form submissions

### Database Indexes
The system includes optimized database indexes for:
- Foreign key relationships
- Status-based queries
- Date-based filtering
- Composite queries for performance

### Sample Data
Run the seeder to populate the database with sample data:
```bash
php artisan db:seed --class=InitialSetupSeeder
```

## 📱 Usage

### Admin Panel
Access the admin panel at: `http://localhost:8000/admin`

**Default Admin Credentials:**
- Email: `admin@school.com`
- Password: `password`

### Guardian Portal
Access the guardian portal at: `http://localhost:8000/guardian`

**Default Guardian Credentials:**
- Email: `guardian@school.com`
- Password: `password`

### Driver Portal
Access the driver portal at: `http://localhost:8000/driver`

**Default Driver Credentials:**
- Email: `driver@school.com`
- Password: `password`

### Key Features Usage

#### 1. Student Management
- Add new students with location data
- Assign guardians to students
- Track student transportation history
- Export student data

#### 2. Vehicle Management
- Register vehicles with specifications
- Assign drivers to vehicles
- Track vehicle availability
- Monitor vehicle performance

#### 3. Trip Management
- Create new trips
- Assign students to trips
- Track trip progress in real-time
- Update trip status

#### 4. Route Planning
- Create optimized routes
- Assign vehicles to routes
- Monitor route performance
- Update route information

#### 5. Real-time Tracking
- Monitor active trips
- Track vehicle locations
- Update trip status
- Send notifications

## 🚀 Performance Optimization

### Built-in Performance Features
- **Database Indexing**: Optimized queries with strategic indexes
- **Caching Strategy**: Multi-level caching for better performance
- **Query Optimization**: Reduced N+1 query problems
- **Asset Optimization**: Minified and compressed assets
- **Memory Management**: Efficient memory usage patterns

### Performance Commands
```bash
# Run performance tests
php artisan performance:test --all

# Monitor performance metrics
php artisan performance:monitor --metrics

# Clear all caches
php artisan performance:monitor --clear-cache

# Optimize database
php artisan performance:monitor --optimize
```

### Performance Monitoring
The system includes automatic performance monitoring:
- Slow query detection
- Memory usage monitoring
- Cache hit rate tracking
- Response time analysis

## 📊 API Documentation

### Authentication
All API endpoints require authentication via Laravel Sanctum.

### Key Endpoints

#### Dashboard API
```http
GET /api/dashboard/stats
GET /api/dashboard/charts?period=30
```

#### Students API
```http
GET /api/students
POST /api/students
GET /api/students/{id}
PUT /api/students/{id}
DELETE /api/students/{id}
```

#### Trips API
```http
GET /api/trips
POST /api/trips
GET /api/trips/{id}
PUT /api/trips/{id}
DELETE /api/trips/{id}
GET /api/trips/{id}/track
```

#### Vehicles API
```http
GET /api/vehicles
POST /api/vehicles
GET /api/vehicles/{id}
PUT /api/vehicles/{id}
DELETE /api/vehicles/{id}
```

### Response Format
```json
{
    "success": true,
    "data": {
        // Response data
    },
    "message": "Operation successful"
}
```

## 🔧 Troubleshooting

### Common Issues

#### 1. Database Connection Issues
```bash
# Check database configuration
php artisan config:cache
php artisan config:clear
```

#### 2. Cache Issues
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

#### 3. Asset Issues
```bash
# Rebuild assets
npm run build
php artisan storage:link
```

#### 4. Permission Issues
```bash
# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

#### 5. Performance Issues
```bash
# Run performance optimization
php artisan performance:monitor --optimize
php artisan performance:monitor --clear-cache
```

### Debug Mode
Enable debug mode for development:
```env
APP_DEBUG=true
APP_ENV=local
LOG_LEVEL=debug
```

### Log Files
Check log files for errors:
```bash
tail -f storage/logs/laravel.log
```

## 🛠️ Development

### Development Setup
```bash
# Install development dependencies
composer install --dev

# Run development server
php artisan serve

# Watch for asset changes
npm run dev
```

### Code Style
The project follows PSR-12 coding standards:
```bash
# Check code style
./vendor/bin/phpcs

# Fix code style issues
./vendor/bin/phpcbf
```

### Testing
```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter=StudentTest
```

### Database Testing
```bash
# Refresh database for testing
php artisan migrate:fresh --seed
```

## 📈 Monitoring and Analytics

### Performance Metrics
- Response time monitoring
- Memory usage tracking
- Database query performance
- Cache hit rates
- User activity analytics

### Logging
- Application logs: `storage/logs/laravel.log`
- Performance logs: Automatic slow query logging
- Error logs: Comprehensive error tracking

### Health Checks
```bash
# Check system health
php artisan performance:monitor --metrics

# Check database connectivity
php artisan tinker
>>> DB::connection()->getPdo();
```

## 🔒 Security

### Security Features
- CSRF protection
- SQL injection prevention
- XSS protection
- Input validation
- Role-based access control
- Secure password hashing

### Security Best Practices
- Keep dependencies updated
- Use environment variables for sensitive data
- Enable HTTPS in production
- Regular security audits
- Backup data regularly

## 📦 Deployment

### Production Deployment
1. Set production environment variables
2. Optimize assets: `npm run build`
3. Clear caches: `php artisan cache:clear`
4. Set proper file permissions
5. Configure web server
6. Set up SSL certificate
7. Configure database backups

### Docker Deployment (Optional)
```dockerfile
# Dockerfile example
FROM php:8.1-fpm
# ... Docker configuration
```

## 🤝 Contributing

### Contributing Guidelines
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests for new features
5. Submit a pull request

### Code Standards
- Follow PSR-12 coding standards
- Write comprehensive tests
- Document new features
- Update documentation

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

### Getting Help
- Check the [troubleshooting section](#-troubleshooting)
- Review the [performance optimization guide](PERFORMANCE_OPTIMIZATION.md)
- Check GitHub issues for known problems
- Contact support for enterprise features

### Documentation
- [Performance Optimization Guide](PERFORMANCE_OPTIMIZATION.md)
- [API Documentation](#-api-documentation)
- [Database Schema](#-database-setup)

## 🎉 Acknowledgments

- Laravel Framework
- Vuexy Admin Template
- Leaflet.js for mapping
- Chart.js for analytics
- Bootstrap for UI components

---

**Made with ❤️ for School Transportation Management**