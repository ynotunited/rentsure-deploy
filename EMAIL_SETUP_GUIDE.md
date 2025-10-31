# RentSure Email Notification Setup Guide

## 📧 Email Configuration

### 1. Update Your .env File

Replace the placeholder values in your `.env` file with your actual email credentials:

```env
# Mail Configuration
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_actual_email@gmail.com
MAIL_PASSWORD=your_app_password_here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@rentsure.com
MAIL_FROM_NAME="RentSure"

# Queue Configuration (for email processing)
QUEUE_CONNECTION=database
```

### 2. Gmail Setup (Recommended)

For Gmail, you need to:
1. Enable 2-Factor Authentication on your Google account
2. Generate an App Password:
   - Go to Google Account settings
   - Security → 2-Step Verification → App passwords
   - Generate password for "Mail"
   - Use this password in `MAIL_PASSWORD`

### 3. Alternative Email Providers

**Mailgun:**
```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-secret
```

**SendGrid:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
```

## 🚀 Email Notifications Implemented

### 1. User Registration Welcome Email
- **Trigger:** When user completes registration
- **Recipients:** New user
- **Content:** Welcome message, account details, next steps

### 2. Property Added Notification
- **Trigger:** When landlord adds a new property
- **Recipients:** Property owner
- **Content:** Property details, listing confirmation

### 3. Review System Notifications
- **Trigger:** When tenant submits a review
- **Recipients:** Landlord (for approval) + Tenant (confirmation)
- **Content:** Review details, approval links

### 4. Verification Status Updates
- **Trigger:** When admin approves/rejects verification
- **Recipients:** User being verified
- **Content:** Status update, next steps

### 5. Agent-Landlord Relationship
- **Trigger:** Agent requests verification from landlord
- **Recipients:** Landlord (request) + Agent (status update)
- **Content:** Agent details, approval actions

## 🔧 Running Email Queue

### Start the Queue Worker
```bash
php artisan queue:work
```

### Process Queue in Background (Production)
```bash
php artisan queue:work --daemon
```

### Check Queue Status
```bash
php artisan queue:monitor
```

## 📋 Integration Examples

### In Controllers
```php
use App\Services\NotificationService;

// Send welcome email
NotificationService::sendWelcomeEmail($user);

// Send property notification
NotificationService::sendPropertyAddedEmail($property);

// Send review notification
NotificationService::sendReviewSubmittedEmail($review);
```

### In Event Listeners
```php
// In EventServiceProvider
protected $listen = [
    'App\Events\PropertyCreated' => [
        'App\Listeners\SendPropertyNotification',
    ],
];
```

## 🎨 Email Templates

All emails use Laravel's built-in Markdown templates with:
- **RentSure branding** - Consistent colors and styling
- **Nigerian context** - Localized content and currency
- **Mobile-friendly** - Responsive design
- **Action buttons** - Direct links to relevant pages

## 🔍 Testing Emails

### Test Email Configuration
```bash
php artisan tinker
```

```php
// Test basic email
Mail::raw('Test email from RentSure', function ($message) {
    $message->to('test@example.com')->subject('Test Email');
});

// Test notification
$user = App\Models\User::first();
$user->notify(new App\Notifications\UserRegistered($user));
```

### Log Emails (Development)
For testing, you can use log driver:
```env
MAIL_MAILER=log
```
Emails will be saved to `storage/logs/laravel.log`

## 🚨 Important Notes

1. **Queue Processing:** Emails are queued for better performance
2. **Error Handling:** Failed emails are logged for debugging
3. **Rate Limiting:** Respect email provider limits
4. **Spam Prevention:** Use proper from addresses and content
5. **GDPR Compliance:** Users can opt-out of notifications

## 📊 Monitoring

### Check Failed Jobs
```bash
php artisan queue:failed
```

### Retry Failed Jobs
```bash
php artisan queue:retry all
```

### Clear Failed Jobs
```bash
php artisan queue:flush
```

## 🔐 Security Best Practices

1. **Never commit email credentials** to version control
2. **Use environment variables** for all sensitive data
3. **Enable 2FA** on email accounts
4. **Use app passwords** instead of account passwords
5. **Monitor email logs** for suspicious activity

## 📈 Production Deployment

1. **Use a dedicated email service** (Mailgun, SendGrid, SES)
2. **Set up proper DNS records** (SPF, DKIM, DMARC)
3. **Monitor delivery rates** and bounce rates
4. **Use queue workers** with process managers (Supervisor)
5. **Set up email alerts** for system failures

---

Your RentSure platform now has comprehensive email notifications for all major events! 🎉📧
