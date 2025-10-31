# 🏠 RentSure Setup Guide

## 🎯 Complete Nigerian Rental Verification Platform

Your RentSure platform now includes all core features for tenant-landlord verification in Nigeria!

## 📋 Setup Steps

### 1. Database Migration
Run all the new migrations:
```bash
cd c:\laragon\www\rentsure
php artisan migrate
```

### 2. Google Maps API Setup
1. Get API key from [Google Cloud Console](https://console.cloud.google.com/)
2. Enable: Maps JavaScript API, Places API, Geocoding API
3. Add to `.env`:
```env
GOOGLE_MAPS_API_KEY=your_actual_api_key_here
```

### 3. File Storage Setup
Ensure storage is linked for document uploads:
```bash
php artisan storage:link
```

### 4. Create Admin User (Optional)
```bash
php artisan tinker
```
```php
$admin = App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@rentsure.com',
    'phone_number' => '08012345678',
    'role' => 'admin',
    'state' => 'Lagos',
    'password' => bcrypt('password'),
    'email_verified_at' => now(),
]);
```

## 🎉 Core Features Implemented

### ✅ **Tenant Features**
- **NIN Registration** - Required for tenant verification
- **Document Upload** - Live photo, ID, rental documents
- **Address Verification** - Google Maps integration
- **Verification Badge** - Admin-approved trust badge
- **Profile Dashboard** - Complete verification status

### ✅ **Landlord Features**
- **Tenant Search** - By name, phone, or NIN
- **Verification Check** - View tenant trust scores
- **Review System** - Rate and comment on tenants
- **Property Management** - Add/manage properties
- **Agent Verification** - Approve agents to manage properties

### ✅ **Agent Features**
- **Landlord Linking** - Request verification from landlords
- **Tenant Management** - Add tenants on behalf of landlords
- **Review Submission** - Reviews pending landlord approval
- **Property Access** - Manage verified landlord properties

### ✅ **Admin Features**
- **User Management** - All roles and verification status
- **Document Approval** - Review and approve tenant documents
- **Badge Verification** - Grant verification badges
- **Platform Analytics** - User stats and activity
- **Dispute Resolution** - Handle review disputes

## 🔧 Technical Features

### **Security & Verification**
- NIN validation with mock API (ready for real NIMC integration)
- Google Maps address verification (Nigeria-only)
- Document upload with file validation
- Role-based access control
- Admin approval workflows

### **User Experience**
- Mobile-first responsive design
- Inter font integration
- Real-time form validation
- Visual status indicators
- Modern UI with Tailwind CSS

### **Database Structure**
- Multi-role user system
- Document management with approval status
- Verification request workflow
- Property-tenant relationships
- Review system with ratings

## 🚀 Testing the System

### **1. Registration Flow**
1. Visit `/register`
2. Test tenant registration with NIN requirement
3. Test landlord/agent registration (NIN optional)
4. Verify Google Maps address autocomplete

### **2. Tenant Workflow**
1. Login as tenant
2. Upload documents (live photo, ID)
3. Request verification badge
4. Check dashboard status

### **3. Landlord Workflow**
1. Login as landlord
2. Search for tenants by name/phone/NIN
3. View tenant profiles and verification status
4. Leave reviews for tenants

### **4. Admin Workflow**
1. Login as admin
2. Review pending documents
3. Approve/reject verification requests
4. Manage user accounts

## 📱 Mobile Experience

- **Onboarding Screens** - 3-screen mobile welcome
- **Background Image** - Full-screen coverage
- **Responsive Forms** - Touch-friendly inputs
- **Mobile Navigation** - Optimized for mobile use

## 🔐 Security Notes

- API keys stored in environment variables
- File uploads validated and secured
- Role-based middleware protection
- CSRF protection on all forms
- Input validation and sanitization

## 🌍 Nigerian Market Features

- **NIN Integration** - Nigerian National ID verification
- **State Selection** - All 36 states + FCT
- **Address Verification** - Nigeria-restricted Google Maps
- **Local Phone Format** - Nigerian phone number validation
- **Multi-language Ready** - Prepared for localization

## 🎯 Next Steps (Optional Enhancements)

1. **Real NIMC API** - Replace mock with actual NIN verification
2. **SMS Verification** - Phone number verification
3. **Payment Integration** - Subscription tiers
4. **Email Notifications** - Status updates and alerts
5. **Mobile App** - Native iOS/Android apps
6. **Advanced Analytics** - Detailed platform insights

## 🆘 Support

Your RentSure platform is now a **complete tenant verification system** ready for the Nigerian rental market! 

**Key URLs:**
- `/` - Welcome page with mobile onboarding
- `/register` - Enhanced registration with NIN/address verification
- `/login` - Modern login interface
- `/tenant/dashboard` - Tenant verification center
- `/landlord/dashboard` - Landlord tenant search
- `/admin/dashboard` - Admin management panel

🎉 **Congratulations! Your Nigerian rental verification platform is ready to launch!**
