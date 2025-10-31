# RentSure Installation Guide

RentSure is a web-based platform for tenant-landlord verification and reviews in the Nigerian market. This guide will help you set up the application for local development or production deployment.

## Requirements

- PHP 8.0 or higher
- MySQL 8.0 or higher
- Composer
- Node.js and NPM
- Web server (Apache/Nginx)

## Installation Steps

### 1. Clone the Repository

```bash
git clone <repository-url> rentsure
cd rentsure
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
npm run dev
```

### 4. Environment Setup

```bash
cp .env.example .env
```

Edit the `.env` file to configure your database connection and other settings:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rentsure
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Migrations and Seed Database

```bash
php artisan migrate
php artisan db:seed
```

### 7. Create Storage Symlink

```bash
php artisan storage:link
```

### 8. Set Directory Permissions

```bash
chmod -R 775 storage bootstrap/cache
```

### 9. Start Local Development Server

```bash
php artisan serve
```

Your application should now be accessible at `http://localhost:8000`.

## Default Admin Account

After seeding the database, you can log in with the following admin account:

- Email: admin@rentsure.com
- Password: password

Be sure to change this password after your first login.

## Configuration Options

### Mail Configuration

To enable email notifications, configure your mail settings in the `.env` file:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@rentsure.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### File Storage

By default, user documents and images are stored in the `storage/app/public` directory. You can configure different storage drivers in the `.env` file:

```
FILESYSTEM_DRIVER=public
```

## Production Deployment

For production environments, make sure to:

1. Set `APP_ENV=production` and `APP_DEBUG=false` in your `.env` file
2. Configure a proper web server (Nginx/Apache) with PHP-FPM
3. Set up a secure SSL certificate
4. Optimize the application:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

## Troubleshooting

### Common Issues

#### 1. Permission Denied

If you encounter permission issues, make sure your web server has write permissions to the `storage` and `bootstrap/cache` directories.

#### 2. Database Connection Error

Verify that your database credentials are correct in the `.env` file and that your MySQL server is running.

#### 3. 500 Server Error

Check the Laravel log files in `storage/logs/laravel.log` for detailed error information.

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

## Support

For additional support or questions, please contact the development team.
