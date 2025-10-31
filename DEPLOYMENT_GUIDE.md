# RentSure Free Deployment Guide 🚀

## 🆓 Best Free Hosting Options for Team Testing

### 1. **Railway (Recommended) - Free Tier**
- **✅ Pros:** Easy Laravel deployment, MySQL included, custom domains
- **💰 Free Tier:** $5 credit monthly (usually enough for testing)
- **🔗 Setup:** Connect GitHub repo, auto-deploy

### 2. **Heroku (Popular Choice)**
- **✅ Pros:** Well-documented, PostgreSQL included, easy scaling
- **💰 Free Tier:** 550-1000 dyno hours/month
- **🔗 Setup:** Git-based deployment

### 3. **Render (Modern Alternative)**
- **✅ Pros:** Fast deployment, PostgreSQL included, SSL certificates
- **💰 Free Tier:** 750 hours/month, sleeps after 15min inactivity
- **🔗 Setup:** GitHub integration

### 4. **PlanetScale + Vercel (Database + Frontend)**
- **✅ Pros:** Serverless MySQL, fast CDN
- **💰 Free Tier:** 1GB database, unlimited bandwidth
- **🔗 Setup:** Separate database and app hosting

## 🚀 Quick Deploy: Railway (Recommended)

### Step 1: Prepare Your Repository
```bash
# Initialize git if not already done
git init
git add .
git commit -m "Initial RentSure deployment"

# Push to GitHub
git remote add origin https://github.com/yourusername/rentsure.git
git push -u origin main
```

### Step 2: Railway Deployment
1. **Sign up:** Go to [railway.app](https://railway.app)
2. **Connect GitHub:** Link your repository
3. **Deploy:** Click "Deploy from GitHub repo"
4. **Select:** Choose your RentSure repository

### Step 3: Configure Environment Variables
In Railway dashboard, add these variables:
```env
APP_NAME=RentSure
APP_ENV=production
APP_KEY=base64:q7X8IcP09P+AT9uXJhrMHjfUS5ihLctDBNSZhEN9U70=
APP_DEBUG=false
APP_URL=https://your-app-name.up.railway.app

DB_CONNECTION=mysql
DB_HOST=${{MYSQLHOST}}
DB_PORT=${{MYSQLPORT}}
DB_DATABASE=${{MYSQLDATABASE}}
DB_USERNAME=${{MYSQLUSER}}
DB_PASSWORD=${{MYSQLPASSWORD}}

# Email Configuration (use your Gmail)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@rentsure.com
MAIL_FROM_NAME="RentSure"

# Queue Configuration
QUEUE_CONNECTION=database

# Google Maps (add your key)
GOOGLE_MAPS_API_KEY=your_google_maps_api_key_here
```

### Step 4: Add Railway MySQL Database
1. **Add Service:** Click "New" → "Database" → "MySQL"
2. **Auto-connect:** Railway will provide database variables
3. **Migration:** Run migrations automatically on deploy

## 🚀 Alternative: Heroku Deployment

### Step 1: Install Heroku CLI
```bash
# Download from: https://devcenter.heroku.com/articles/heroku-cli
# Or use npm:
npm install -g heroku
```

### Step 2: Heroku Setup
```bash
# Login to Heroku
heroku login

# Create app
heroku create rentsure-team-testing

# Add MySQL addon (ClearDB - Free tier)
heroku addons:create cleardb:ignite

# Get database URL
heroku config:get CLEARDB_DATABASE_URL
```

### Step 3: Configure Heroku Environment
```bash
# Set environment variables
heroku config:set APP_NAME=RentSure
heroku config:set APP_ENV=production
heroku config:set APP_KEY=base64:q7X8IcP09P+AT9uXJhrMHjfUS5ihLctDBNSZhEN9U70=
heroku config:set APP_DEBUG=false

# Email settings
heroku config:set MAIL_MAILER=smtp
heroku config:set MAIL_HOST=smtp.gmail.com
heroku config:set MAIL_PORT=587
heroku config:set MAIL_USERNAME=your_email@gmail.com
heroku config:set MAIL_PASSWORD=your_app_password
```

### Step 4: Deploy to Heroku
```bash
# Add Heroku remote
git remote add heroku https://git.heroku.com/rentsure-team-testing.git

# Deploy
git push heroku main

# Run migrations
heroku run php artisan migrate --force

# Create admin user
heroku run php artisan tinker
```

## 📁 Required Files for Deployment

### 1. Create Procfile (for Heroku)
```bash
# Create in root directory
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
```

### 2. Update composer.json
```json
{
    "require": {
        "php": "^8.0",
        "laravel/framework": "^9.0"
    },
    "scripts": {
        "post-install-cmd": [
            "php artisan clear-compiled",
            "php artisan optimize",
            "chmod -R 755 storage"
        ]
    }
}
```

### 3. Create .htaccess (if needed)
```apache
# In public/.htaccess
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>
```

## 🔧 Production Optimizations

### 1. Update .env for Production
```env
APP_ENV=production
APP_DEBUG=false
LOG_CHANNEL=errorlog
SESSION_SECURE_COOKIE=true
```

### 2. Optimize Laravel
```bash
# Run these after deployment
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 3. Database Seeding
```bash
# Create admin user and sample data
php artisan db:seed --class=AdminUserSeeder
```

## 🌐 Custom Domain (Optional)

### Railway Custom Domain
1. **Go to:** Railway dashboard → Settings → Domains
2. **Add:** your-domain.com
3. **DNS:** Point CNAME to railway.app

### Heroku Custom Domain
```bash
# Add custom domain
heroku domains:add www.rentsure-testing.com

# Get DNS target
heroku domains
```

## 👥 Team Access & Testing

### 1. Share Testing URL
```
https://your-app-name.up.railway.app
or
https://rentsure-team-testing.herokuapp.com
```

### 2. Create Test Accounts
```php
// Admin account
Email: admin@rentsure.com
Password: admin123

// Test users for each role
Tenant: tenant@test.com / password
Landlord: landlord@test.com / password  
Agent: agent@test.com / password
```

### 3. Testing Checklist
- ✅ **Registration:** All user roles can register
- ✅ **Login:** Authentication works properly
- ✅ **Mobile:** Responsive design on phones
- ✅ **Email:** Notifications are sent
- ✅ **Properties:** Landlords can add properties
- ✅ **Reviews:** Tenant review system works
- ✅ **Verification:** Document upload functions

## 🔍 Monitoring & Debugging

### Check Logs
```bash
# Railway
railway logs

# Heroku  
heroku logs --tail
```

### Database Access
```bash
# Railway
railway connect mysql

# Heroku
heroku run php artisan tinker
```

## 💡 Cost Optimization Tips

1. **Use free tiers** for initial testing
2. **Monitor usage** to stay within limits
3. **Scale up** only when needed
4. **Use CDN** for static assets (Cloudflare free)
5. **Optimize images** to reduce bandwidth

## 🚨 Important Notes

- **Free tiers** may have limitations (sleep after inactivity)
- **Database storage** is limited on free plans
- **Email limits** apply to free SMTP services
- **Custom domains** may require paid plans
- **SSL certificates** are usually included

---

Your RentSure app will be live and accessible to your team for testing! 🎉🌐

**Recommended:** Start with Railway for easiest setup, then migrate to paid hosting when ready for production.
