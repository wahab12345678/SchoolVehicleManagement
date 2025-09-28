<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

# SchoolVehicleManagement — Project Setup

This section describes how to get the project running locally and how to run migrations and seeders.

## Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm (optional, for frontend assets)
- A database (MySQL/MariaDB recommended)

## Quick start (Windows / PowerShell)

1. Install PHP dependencies:

```powershell
composer install
```

2. Copy and edit environment file:

```powershell
copy .env.example .env
# open .env and set DB_* values
```

3. Generate app key:

```powershell
php artisan key:generate
```

4. Run migrations and seeders (single command):

```powershell
php artisan migrate --seed
```

If migrations fail due to duplicate CNIC values, run the duplicate finder in tinker to identify problematic rows before applying the unique constraint.

5. (Optional) Build front-end assets:

```powershell
npm install
npm run build
```

6. Serve the application locally:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

Login with seeded admin credentials:

- Email: admin@example.com
- Password: password

## Notes
- The app normalizes phone numbers to `92...` format; frontend attempts to normalize before submit and the repository normalizes server-side too.
- The guardians `cnic` column has a unique index; if a migration fails because of duplicates, run the duplicate detection query and resolve duplicates before migrating.

## Queue & Mail

This project queues contact notification emails so the API response remains fast. To enable and process queued mails locally:

1. Set the queue driver in `.env`:

```powershell
# use the database queue driver for local development
QUEUE_CONNECTION=database
```

2. Ensure mail is configured in `.env`. For local testing you can use the `log` mailer; for real delivery configure `smtp` or a transactional provider like Mailgun.

```powershell
MAIL_MAILER=log
# MAIL_ADMIN will receive contact notifications
MAIL_ADMIN=admin@example.com
```

3. Create the queue tables (a migration is included in the repository) and run migrations:

```powershell
php artisan migrate
```

4. Run a worker to process queued jobs:

```powershell
php artisan queue:work --tries=3
```

For production, supervise the worker (Supervisor / systemd) or use a managed queue service. Monitor `failed_jobs` and configure alerts as needed.

If you hit errors running the migrate/seed step, paste the full error output and I'll guide you through the exact fix.
