# RentSure Deployment on Hostinger 🚀

## 🎯 Hostinger-Specific Deployment Guide

Since you already have Hostinger hosting, this will be very straightforward!

## 📋 What You Have with Hostinger:
- ✅ **cPanel access** (hPanel - Hostinger's version)
- ✅ **MySQL databases** (unlimited)
- ✅ **PHP 8.1+ support** (perfect for Laravel)
- ✅ **File Manager** (easy upload)
- ✅ **Free SSL certificate**
- ✅ **Email accounts** (professional)

## 🚀 Step-by-Step Deployment

### Step 1: Access Your Hostinger hPanel
1. **Login to:** [hostinger.com](https://hostinger.com)
2. **Go to:** hPanel (Hostinger Control Panel)
3. **Select:** Your domain/hosting account

### Step 2: Prepare RentSure Files
On your local machine, create a deployment package:

**Option A: Manual Selection**
Create a folder with these files/folders:
```
rentsure-hostinger/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/ (run composer install --no-dev first)
├── .env (we'll configure this)
├── artisan
├── composer.json
├── install.php
└── web.config (if needed)
```

**Option B: Zip Everything (Exclude These)**
```bash
# Create zip excluding unnecessary files
# Exclude: .git, node_modules, .env (we'll create new one)
```

### Step 3: Upload Files to Hostinger

#### Using File Manager (Recommended):
1. **hPanel** → **File Manager**
2. **Navigate to:** `public_html` folder
3. **Upload:** Your zip file or individual folders
4. **Extract:** If you uploaded a zip file
5. **Move public folder contents:** 
   - Copy everything from `public/` folder
   - Paste into `public_html` root
   - Delete the now-empty `public/` folder

#### File Structure Should Look Like:
```
public_html/
├── index.php (from public folder)
├── .htaccess (from public folder)
├── css/ (from public folder)
├── js/ (from public folder)  
├── images/ (from public folder)
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env (create this)
└── install.php
```

### Step 4: Create MySQL Database

1. **hPanel** → **MySQL Databases**
2. **Create Database:**
   - Database name: `rentsure_db` (or any name)
   - Click "Create"
3. **Create Database User:**
   - Username: `rentsure_user`
   - Password: Strong password (save this!)
   - Click "Create User"
4. **Add User to Database:**
   - Select user and database
   - Grant "All Privileges"
   - Click "Add"

**Note Down These Details:**
- Database Host: Usually `localhost` or `mysql.hostinger.com`
- Database Name: `u123456789_rentsure` (Hostinger adds prefix)
- Username: `u123456789_rentsure_user`
- Password: Your chosen password

### Step 5: Configure .env File

Create `.env` file in `public_html` root:

```env
APP_NAME=RentSure
APP_ENV=production
APP_KEY=base64:q7X8IcP09P+AT9uXJhrMHjfUS5ihLctDBNSZhEN9U70=
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database (use your Hostinger database details)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_rentsure
DB_USERNAME=u123456789_rentsure_user
DB_PASSWORD=your_database_password

# Session & Cache (file-based for shared hosting)
SESSION_DRIVER=file
SESSION_LIFETIME=120
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Email Configuration (use your domain email or Gmail)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=noreply@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="RentSure"

# Alternative: Use Gmail
# MAIL_HOST=smtp.gmail.com
# MAIL_USERNAME=your_gmail@gmail.com
# MAIL_PASSWORD=your_app_password

# Google Maps API
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here

# File Storage
FILESYSTEM_DISK=local
```

### Step 6: Set File Permissions

In **File Manager**, set permissions:
- **storage/** folder: 755 or 777
- **bootstrap/cache/** folder: 755 or 777
- **All PHP files:** 644
- **All folders:** 755

**How to set permissions in Hostinger:**
1. Right-click folder/file
2. Select "Permissions" 
3. Set to 755 for folders, 644 for files

### Step 7: Run Installation

1. **Visit:** `https://yourdomain.com/install.php`
2. **Click:** "Install RentSure" button
3. **Wait:** For automatic setup (30-60 seconds)
4. **Success:** You'll see test account credentials

### Step 8: Set Up Email (Hostinger Professional Email)

#### Option A: Use Hostinger Email
1. **hPanel** → **Email Accounts**
2. **Create:** `noreply@yourdomain.com`
3. **Set password** and note credentials
4. **Use in .env:** Hostinger SMTP settings

#### Option B: Use Gmail (Easier)
```env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
```

## 🔧 Hostinger-Specific Optimizations

### 1. Update index.php for Shared Hosting
The `index.php` should already be correct, but verify:
```php
<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
```

### 2. Create/Verify .htaccess
In `public_html` root:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Handle Angular/Vue Router (if needed)
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

# Security
Options -Indexes
<Files .env>
    Order allow,deny
    Deny from all
</Files>

# PHP Settings (if needed)
<IfModule mod_php8.c>
    php_value upload_max_filesize 10M
    php_value post_max_size 10M
    php_value memory_limit 256M
    php_value max_execution_time 300
</IfModule>
```

### 3. Hostinger PHP Version
1. **hPanel** → **PHP Configuration**
2. **Select:** PHP 8.1 or 8.2 (recommended)
3. **Enable extensions:** mbstring, openssl, pdo_mysql, tokenizer, xml

## 🌐 Domain Configuration

### If Using Main Domain:
- Your app will be at: `https://yourdomain.com`
- Update `APP_URL` in `.env` accordingly

### If Using Subdomain:
1. **hPanel** → **Subdomains**
2. **Create:** `rentsure.yourdomain.com`
3. **Point to:** `public_html` folder
4. **Update:** `APP_URL=https://rentsure.yourdomain.com`

## 📧 Email Testing

After setup, test emails:
1. **Register new user** on your site
2. **Check:** If welcome email is received
3. **Verify:** Email settings in hPanel if issues

## 🔍 Testing Checklist

Visit your live site and test:
- ✅ **Homepage loads:** Main page displays correctly
- ✅ **Registration:** Create new user account
- ✅ **Login:** Use test credentials
- ✅ **Mobile responsive:** Test on phone
- ✅ **Email notifications:** Registration emails work
- ✅ **Database:** User data is saved
- ✅ **File uploads:** Profile pictures work
- ✅ **All user roles:** Admin, Landlord, Agent, Tenant

## 🎯 Test Accounts (After Installation)

Share these with your team:
- **Admin:** admin@rentsure.com / admin123
- **Landlord:** landlord@test.com / password
- **Agent:** agent@test.com / password  
- **Tenant:** tenant@test.com / password

## 🚨 Troubleshooting

### Database Connection Issues:
- Check database credentials in `.env`
- Verify database user has all privileges
- Ensure database host is correct (usually `localhost`)

### 500 Internal Server Error:
- Check `.htaccess` file syntax
- Verify file permissions (storage/ = 755)
- Check PHP version is 8.1+

### Email Not Working:
- Test with Gmail first (easier setup)
- Check Hostinger email account credentials
- Verify SMTP settings in `.env`

### File Upload Issues:
- Check `storage/` folder permissions (755 or 777)
- Verify PHP upload limits in hPanel

## 💡 Hostinger Advantages

- **Fast SSD storage** - Quick loading times
- **Free SSL certificate** - Automatic HTTPS
- **24/7 support** - Live chat available
- **99.9% uptime** - Reliable hosting
- **Easy backups** - One-click restore
- **Professional email** - Branded email addresses

## 🎉 Success!

Your RentSure app is now live on Hostinger! 

**Time to deploy:** 20-30 minutes
**Your team can access:** `https://yourdomain.com`
**All features working:** Mobile design, emails, user management

Perfect for team testing and even production use! 🚀🇳🇬
