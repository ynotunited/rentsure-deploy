# RentSure Subfolder Deployment Guide 📁

## 🎯 Deploy RentSure in a Subfolder of Existing Website

This guide shows how to install RentSure as a subfolder like:
- `https://yourexistingsite.com/rentsure/`
- `https://yourexistingsite.com/rental/`
- `https://yourexistingsite.com/app/`

## 📋 Subfolder Structure Overview

Your existing site structure will become:
```
public_html/
├── index.html (your existing site)
├── about.html (your existing files)
├── css/ (your existing assets)
├── images/ (your existing assets)
└── rentsure/ (NEW - RentSure app)
    ├── index.php (Laravel entry point)
    ├── .htaccess (Laravel routing)
    ├── css/ (RentSure assets)
    ├── js/ (RentSure assets)
    ├── images/ (RentSure assets)
    ├── app/ (Laravel app folder)
    ├── bootstrap/ (Laravel bootstrap)
    ├── config/ (Laravel config)
    ├── database/ (Laravel database)
    ├── resources/ (Laravel resources)
    ├── routes/ (Laravel routes)
    ├── storage/ (Laravel storage)
    ├── vendor/ (Laravel dependencies)
    ├── .env (RentSure configuration)
    └── install.php (Installation script)
```

## 🚀 Step-by-Step Subfolder Deployment

### Step 1: Choose Your Subfolder Name
Pick a folder name for RentSure:
- `rentsure` (recommended)
- `rental`
- `app`
- `property`
- Any name you prefer

### Step 2: Prepare RentSure Files
Create a deployment package with these modifications:

#### Required File Changes:

**A. Update index.php**
The main `index.php` needs path adjustments:
```php
<?php
// Update paths for subfolder deployment
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

// Handle subfolder routing
$request = Illuminate\Http\Request::capture();
$response = $app->handle($request);
$response->send();
$app->terminate($request, $response);
```

**B. Update .env Configuration**
```env
APP_NAME=RentSure
APP_ENV=production
APP_KEY=base64:q7X8IcP09P+AT9uXJhrMHjfUS5ihLctDBNSZhEN9U70=
APP_DEBUG=false
APP_URL=https://yourexistingsite.com/rentsure

# Database (same as before)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_rentsure
DB_USERNAME=u123456789_user
DB_PASSWORD=your_password

# Asset URL (important for subfolder)
ASSET_URL=https://yourexistingsite.com/rentsure

# Other settings remain the same...
```

**C. Create Subfolder .htaccess**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Set base for subfolder
    RewriteBase /rentsure/
    
    # Handle Laravel routing
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

# PHP Settings
<IfModule mod_php8.c>
    php_value upload_max_filesize 10M
    php_value post_max_size 10M
    php_value memory_limit 256M
</IfModule>
```

### Step 3: Upload to Hostinger Subfolder

#### Using File Manager:
1. **hPanel** → **File Manager**
2. **Navigate to:** `public_html`
3. **Create folder:** `rentsure` (or your chosen name)
4. **Enter the folder:** Click on `rentsure/`
5. **Upload files:** All RentSure files go here
6. **Extract:** If you uploaded a zip
7. **Move public contents:** Copy `public/` folder contents to `rentsure/` root

#### Final Structure:
```
public_html/
├── (your existing website files)
└── rentsure/
    ├── index.php (from public folder)
    ├── .htaccess (modified for subfolder)
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
    ├── .env (configured for subfolder)
    └── install.php
```

### Step 4: Database Setup (Same as Before)
1. **hPanel** → **MySQL Databases**
2. **Create database:** `rentsure_db`
3. **Create user** with password
4. **Grant privileges** to user

### Step 5: Configure Laravel for Subfolder

#### Update config/app.php (if needed):
```php
// In config/app.php, ensure asset URL is correct
'asset_url' => env('ASSET_URL', null),
```

#### Update any hardcoded URLs in views:
Replace any absolute URLs with Laravel helpers:
```php
// Instead of: /css/app.css
// Use: {{ asset('css/app.css') }}

// Instead of: /images/logo.png  
// Use: {{ asset('images/logo.png') }}
```

### Step 6: Run Subfolder Installation
1. **Visit:** `https://yourexistingsite.com/rentsure/install.php`
2. **Click:** "Install RentSure"
3. **Wait:** For installation to complete
4. **Access app:** `https://yourexistingsite.com/rentsure/`

## 🔧 Subfolder-Specific Configuration

### Update install.php for Subfolder
Modify the installation script:
```php
<?php
// Add subfolder detection
$subfolder = basename(__DIR__);
$baseUrl = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $subfolder;

// Update APP_URL in .env during installation
$envContent = file_get_contents('.env');
$envContent = str_replace('APP_URL=', 'APP_URL=' . $baseUrl, $envContent);
file_put_contents('.env', $envContent);

// Rest of installation script...
?>
```

### Navigation Links
Update any navigation to include subfolder:
```php
// In your Blade templates
<a href="{{ url('/') }}">Home</a>  // Will correctly point to /rentsure/
<a href="{{ route('login') }}">Login</a>  // Will correctly point to /rentsure/login
```

## 🌐 URL Structure

After deployment, your URLs will be:
- **Main app:** `https://yoursite.com/rentsure/`
- **Login:** `https://yoursite.com/rentsure/login`
- **Register:** `https://yoursite.com/rentsure/register`
- **Dashboard:** `https://yoursite.com/rentsure/dashboard`

## 🔗 Integration with Existing Site

### Option 1: Add Link from Main Site
In your existing website, add a link:
```html
<a href="/rentsure/" class="btn">Access RentSure Platform</a>
```

### Option 2: Iframe Integration (Not Recommended)
```html
<iframe src="/rentsure/" width="100%" height="600px"></iframe>
```

### Option 3: Subdomain (Alternative)
Instead of subfolder, consider subdomain:
- Create: `rentsure.yoursite.com`
- Point to: separate folder
- Cleaner URLs and easier management

## 📱 Mobile Considerations

Since RentSure is mobile-first:
- **Subfolder works perfectly** on mobile
- **URLs are clean** and shareable
- **No conflicts** with existing site
- **Independent styling** and functionality

## 🔍 Testing Checklist

Test these URLs after deployment:
- ✅ `https://yoursite.com/rentsure/` - Homepage loads
- ✅ `https://yoursite.com/rentsure/register` - Registration works
- ✅ `https://yoursite.com/rentsure/login` - Login works
- ✅ Assets load correctly (CSS, JS, images)
- ✅ Database connections work
- ✅ Email notifications function
- ✅ File uploads work properly

## 🚨 Common Subfolder Issues & Solutions

### Assets Not Loading:
**Problem:** CSS/JS files return 404
**Solution:** Check `ASSET_URL` in `.env` and use `{{ asset() }}` helper

### Routing Issues:
**Problem:** Links don't work properly
**Solution:** Verify `.htaccess` has correct `RewriteBase`

### Login Redirects:
**Problem:** After login, redirects to wrong URL
**Solution:** Check `APP_URL` in `.env` includes subfolder

### Database Connection:
**Problem:** Can't connect to database
**Solution:** Same database credentials work for subfolder

## 💡 Advantages of Subfolder Deployment

### ✅ Benefits:
- **Keep existing site** unchanged
- **Easy to manage** both sites
- **Shared hosting resources** efficiently used
- **One domain** for everything
- **Easy SSL** coverage

### ⚠️ Considerations:
- **Longer URLs** (includes subfolder)
- **Path complexity** for assets
- **Shared server resources** with main site

## 🎯 Alternative: Subdomain Approach

If you prefer cleaner URLs, consider:
1. **Create subdomain:** `rentsure.yoursite.com`
2. **Point to separate folder:** `/public_html/rentsure/`
3. **Cleaner URLs:** No subfolder in path
4. **Independent management:** Separate from main site

## 🎉 Success!

Your RentSure app is now running at:
**`https://yourexistingsite.com/rentsure/`**

**Test accounts:**
- Admin: admin@rentsure.com / admin123
- Landlord: landlord@test.com / password
- Agent: agent@test.com / password
- Tenant: tenant@test.com / password

Perfect for team testing while keeping your existing website intact! 🚀📱
