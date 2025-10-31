# 🚀 Complete Railway Deployment Guide for RentSure

## 📋 Overview
This guide will take you from your local RentSure project to a fully functional online app that your clients can test. **Total time: 30-45 minutes**.

---

## 🔧 **STEP 1: Prepare Your Project for GitHub**

### 1.1 Create .gitignore file
In your `c:\laragon\www\rentsure` folder, create a file called `.gitignore`:

```gitignore
# Laravel specific
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.phpunit.result.cache
docker-compose.override.yml
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log

# IDE files
.vscode/
.idea/
*.swp
*.swo

# OS files
.DS_Store
Thumbs.db

# Backup files
*.backup
*.bak

# Log files
*.log
storage/logs/*.log

# Cache files
bootstrap/cache/*.php
storage/framework/cache/data/*
storage/framework/sessions/*
storage/framework/views/*

# Compiled assets
/public/css/app.css
/public/js/app.js
/public/mix-manifest.json

# Testing
/coverage
.phpunit.cache
```

### 1.2 Create .env.example
Copy your `.env` file to `.env.example` and remove sensitive data:

```bash
# In your rentsure folder, run:
copy .env .env.example
```

Then edit `.env.example` and replace sensitive values:
```env
APP_NAME=RentSure
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://your-app-url.railway.app

DB_CONNECTION=mysql
DB_HOST=
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

# Email settings (keep structure, remove actual credentials)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@rentsure.com
MAIL_FROM_NAME="RentSure"

QUEUE_CONNECTION=database
```

---

## 🐙 **STEP 2: Create GitHub Repository**

### 2.1 Create GitHub Account (if needed)
- Go to [github.com](https://github.com)
- Sign up for free account
- Verify your email

### 2.2 Create New Repository
1. **Click "New repository"** (green button)
2. **Repository name:** `rentsure`
3. **Description:** `RentSure - Landlord-Tenant Verification Platform for Nigeria`
4. **Visibility:** Private (recommended) or Public
5. **Don't initialize** with README, .gitignore, or license
6. **Click "Create repository"**

### 2.3 Note Your Repository URL
Copy the HTTPS URL (looks like): `https://github.com/yourusername/rentsure.git`
https://github.com/ynotunited/rentsure.git

---

## 💻 **STEP 3: Install Git and Push to GitHub**

### 3.1 Install Git for Windows
1. **Download:** [git-scm.com/download/win](https://git-scm.com/download/win)
2. **Install** with default settings
3. **Restart** your computer

### 3.2 Configure Git (First Time Only)
Open **Command Prompt** or **PowerShell** and run:
```bash
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"
```

### 3.3 Initialize and Push Your Project
1. **Open Command Prompt**
2. **Navigate to your project:**
   ```bash
   cd c:\laragon\www\rentsure
   ```

3. **Initialize Git repository:**
   ```bash
   git init
   ```

4. **Add all files:**
   ```bash
   git add .
   ```

5. **Create first commit:**
   ```bash
   git commit -m "Initial RentSure project setup"
   ```

6. **Add GitHub repository:**
   ```bash
   git remote add origin https://github.com/yourusername/rentsure.git
   ```
   *(Replace with your actual GitHub URL)*

7. **Push to GitHub:**
   ```bash
   git branch -M main
   git push -u origin main
   ```

8. **Enter GitHub credentials** when prompted

✅ **Your project is now on GitHub!**

---

## 🚂 **STEP 4: Deploy to Railway**

### 4.1 Create Railway Account
1. **Go to:** [railway.app](https://railway.app)
2. **Click "Login"**
3. **Sign in with GitHub** (easiest option)
4. **Authorize Railway** to access your repositories

### 4.2 Create New Project
1. **Click "New Project"**
2. **Select "Deploy from GitHub repo"**
3. **Choose your `rentsure` repository**
4. **Click "Deploy Now"**

### 4.3 Railway Auto-Detection
Railway will automatically:
- ✅ Detect it's a Laravel project
- ✅ Install PHP and dependencies
- ✅ Run `composer install`
- ✅ Set up basic environment

---

## 🗄️ **STEP 5: Add Database**

### 5.1 Add MySQL Database
1. **In your Railway project dashboard**
2. **Click "New Service"**
3. **Select "Database"**
4. **Choose "MySQL"**
5. **Click "Add MySQL"**

### 5.2 Get Database Credentials
1. **Click on the MySQL service**
2. **Go to "Variables" tab**
3. **Copy these values:**
   - `MYSQL_HOST`
   - `MYSQL_PORT` 
   - `MYSQL_DATABASE`
   - `MYSQL_USER`
   - `MYSQL_PASSWORD`

---

## ⚙️ **STEP 6: Configure Environment Variables**

### 6.1 Set Laravel Environment Variables
1. **Click on your main service** (not the database)
2. **Go to "Variables" tab**
3. **Add these variables:**

```env
APP_NAME=RentSure
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:q7X8IcP09P+AT9uXJhrMHjfUS5ihLctDBNSZhEN9U70=

# Database (use the values from Step 5.2)
DB_CONNECTION=mysql
DB_HOST=[your_mysql_host]
DB_PORT=[your_mysql_port]
DB_DATABASE=[your_mysql_database]
DB_USERNAME=[your_mysql_user]
DB_PASSWORD=[your_mysql_password]

# Email Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_gmail@gmail.com
MAIL_PASSWORD=your_gmail_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@rentsure.com
MAIL_FROM_NAME=RentSure

# Queue and Cache
QUEUE_CONNECTION=database
CACHE_DRIVER=file
SESSION_DRIVER=file

# File Storage
FILESYSTEM_DISK=local
```

### 6.2 Generate APP_KEY (if needed)
If you need a new APP_KEY:
1. **Go to Railway dashboard**
2. **Click "Deploy Logs"**
3. **Run command:** `php artisan key:generate --show`
4. **Copy the generated key**
5. **Add to APP_KEY variable**

---

## 🚀 **STEP 7: Run Database Migrations**

### 7.1 Access Railway Console
1. **In Railway dashboard**
2. **Click on your main service**
3. **Go to "Deploy Logs"**
4. **Wait for deployment to complete**

### 7.2 Run Migrations and Seeders
1. **Click "Console" tab** (or use Deploy Logs)
2. **Run these commands one by one:**

```bash
php artisan migrate --force
```

```bash
php artisan db:seed --class=TestUserSeeder
```

```bash
php artisan config:cache
```

```bash
php artisan route:cache
```

```bash
php artisan view:cache
```

---

## 🌐 **STEP 8: Get Your Live URL**

### 8.1 Find Your App URL
1. **In Railway dashboard**
2. **Click on your main service**
3. **Go to "Settings" tab**
4. **Find "Public Networking"**
5. **Click "Generate Domain"**
6. **Copy your URL** (like: `rentsure-production-abc123.up.railway.app`)

### 8.2 Update APP_URL
1. **Go back to "Variables" tab**
2. **Update APP_URL** with your new domain:
   ```
   APP_URL=https://rentsure-production-abc123.up.railway.app
   ```
3. **Save changes**

---

## 🧪 **STEP 9: Test Your Live App**

### 9.1 Access Your App
Visit your Railway URL: `https://your-app-url.up.railway.app`

### 9.2 Test Login with Default Accounts
- **Admin:** admin@rentsure.com / admin123
- **Landlord:** landlord@test.com / password
- **Agent:** agent@test.com / password
- **Tenant:** tenant@test.com / password

### 9.3 Test Key Features
- ✅ **User registration**
- ✅ **Role-based dashboards**
- ✅ **Property management** (landlords)
- ✅ **Tenant reviews**
- ✅ **Document uploads**
- ✅ **Mobile responsiveness**

---

## 🎯 **STEP 10: Share with Clients**

### 10.1 Create Client Testing Guide
Share this with your clients:

```
🏠 RentSure Testing Platform

URL: https://your-app-url.up.railway.app

🔑 Test Accounts:
👑 Admin: admin@rentsure.com / admin123
🏠 Landlord: landlord@test.com / password  
🤝 Agent: agent@test.com / password
🏘️ Tenant: tenant@test.com / password

📱 Features to Test:
✅ User registration and login
✅ Property listings and management
✅ Tenant verification system
✅ Review and rating system
✅ Document upload and verification
✅ Mobile-responsive design
✅ Email notifications

💡 Instructions:
1. Visit the URL above
2. Login with any test account
3. Explore the dashboard for your role
4. Test adding properties, reviews, etc.
5. Try on mobile devices
```

---

## 🔧 **Troubleshooting**

### Common Issues:

**1. "500 Internal Server Error"**
- Check Deploy Logs for specific errors
- Ensure all environment variables are set
- Run `php artisan config:clear`

**2. "Database connection failed"**
- Verify database credentials in Variables
- Ensure MySQL service is running
- Check database host/port

**3. "APP_KEY not set"**
- Generate new key: `php artisan key:generate --show`
- Add to APP_KEY variable in Railway

**4. "Storage permissions"**
- Railway handles this automatically
- If issues persist, check Deploy Logs

**5. "Email not working"**
- Verify Gmail app password
- Check MAIL_* variables
- Test with a simple email first

---

## 🎉 **Success Checklist**

✅ Project on GitHub  
✅ Railway deployment working  
✅ Database connected and migrated  
✅ Test users created  
✅ All environment variables set  
✅ Live URL accessible  
✅ Login/register working  
✅ Dashboards loading  
✅ Mobile responsive  
✅ Ready for client testing  

---

## 💡 **Next Steps**

1. **Share URL with clients** for testing
2. **Gather feedback** on features and design
3. **Make updates** by pushing to GitHub (auto-deploys)
4. **Monitor usage** in Railway dashboard
5. **Scale up** when ready (Railway has paid tiers)

---

## 📞 **Support**

If you encounter any issues:
1. **Check Railway Deploy Logs** first
2. **Verify all environment variables**
3. **Test database connection**
4. **Check GitHub repository sync**

**Your RentSure app is now live and ready for client testing!** 🚀🇳🇬
