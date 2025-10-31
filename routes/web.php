<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\LandlordController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/

Route::get('/', function () {
    // Check if the request is from a mobile device
    $isMobile = false;
    $userAgent = request()->header('User-Agent');
    
    if ($userAgent) {
        $mobileKeywords = [
            'Mobile', 'Android', 'iPhone', 'iPad', 'iPod', 'BlackBerry', 
            'Windows Phone', 'Opera Mini', 'IEMobile', 'Mobile Safari'
        ];
        
        foreach ($mobileKeywords as $keyword) {
            if (stripos($userAgent, $keyword) !== false) {
                $isMobile = true;
                break;
            }
        }
    }
    
    // If it's not a mobile device, show the mobile-only message
    if (!$isMobile) {
        return view('mobile-only');
    }
    
    return view('welcome');
});

Route::get('/mobile-only', function () {
    return view('mobile-only');
})->name('mobile.only');

// Public property routes
Route::get('/properties', [App\Http\Controllers\PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{id}', [App\Http\Controllers\PropertyController::class, 'show'])->name('properties.show');

// Authentication Routes
Route::get('/login', function() {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Legal Pages
Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

// Dashboard Route
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Tenant Routes
Route::group(['prefix' => 'tenant', 'middleware' => ['auth', 'role:tenant']], function () {
    Route::get('/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
    Route::get('/profile', [TenantController::class, 'profile'])->name('tenant.profile');
    Route::get('/reviews', [TenantController::class, 'reviews'])->name('tenant.reviews');
    Route::post('/document/upload', [DocumentController::class, 'upload'])->name('tenant.document.upload');
    Route::post('/verification/request', [VerificationController::class, 'requestVerification'])->name('tenant.verification.request');
    Route::post('/review/{review}/dispute', [ReviewController::class, 'dispute'])->name('tenant.review.dispute');
});

// Landlord Routes
Route::group(['prefix' => 'landlord', 'middleware' => ['auth', 'role:landlord']], function () {
    Route::get('/dashboard', [LandlordController::class, 'dashboard'])->name('landlord.dashboard');
    Route::get('/properties', [LandlordController::class, 'properties'])->name('landlord.properties');
    Route::get('/property/create', [PropertyController::class, 'create'])->name('landlord.property.create');
    Route::post('/property/store', [PropertyController::class, 'store'])->name('landlord.property.store');
    Route::get('/property/{property}', [PropertyController::class, 'show'])->name('landlord.property.show');
    Route::get('/property/{property}/edit', [PropertyController::class, 'edit'])->name('landlord.property.edit');
    Route::put('/property/{property}', [PropertyController::class, 'update'])->name('landlord.property.update');
    Route::delete('/property/{property}', [PropertyController::class, 'destroy'])->name('landlord.property.destroy');
    
    // Tenant management for landlords
    Route::get('/tenants', [LandlordController::class, 'tenants'])->name('landlord.tenants');
    Route::get('/tenant/search', [LandlordController::class, 'searchTenants'])->name('landlord.tenant.search');
    Route::post('/tenant/{tenant}/add-to-property/{property}', [LandlordController::class, 'addTenantToProperty'])->name('landlord.tenant.add');
    Route::delete('/tenant/{tenant}/remove-from-property/{property}', [LandlordController::class, 'removeTenantFromProperty'])->name('landlord.tenant.remove');
    
    // Review management for landlords
    Route::get('/reviews', [LandlordController::class, 'reviews'])->name('landlord.reviews');
    Route::post('/tenant/{tenant}/review', [ReviewController::class, 'store'])->name('landlord.review.store');
    Route::put('/review/{review}/update', [ReviewController::class, 'update'])->name('landlord.review.update');
    Route::delete('/review/{review}/delete', [ReviewController::class, 'destroy'])->name('landlord.review.delete');
    
    // Agent review approvals for landlords
    Route::get('/agent-reviews', [LandlordController::class, 'agentReviews'])->name('landlord.agent-reviews');
    Route::post('/review/{review}/approve', [ReviewController::class, 'approve'])->name('landlord.review.approve');
    Route::post('/review/{review}/reject', [ReviewController::class, 'reject'])->name('landlord.review.reject');
    
    // Agent management for landlords
    Route::get('/agents', [LandlordController::class, 'agents'])->name('landlord.agents');
    Route::post('/agent/{agent}/verify', [LandlordController::class, 'verifyAgent'])->name('landlord.agent.verify');
    Route::post('/agent/{agent}/unverify', [LandlordController::class, 'unverifyAgent'])->name('landlord.agent.unverify');
    
    // Tenant search and profile routes
    Route::get('/tenant/search', [LandlordController::class, 'dashboard'])->name('landlord.tenant.search');
    Route::get('/tenant/{tenant}/profile', [LandlordController::class, 'showTenantProfile'])->name('landlord.tenant.profile');
});

// Agent Routes
Route::group(['prefix' => 'agent', 'middleware' => ['auth', 'role:agent']], function () {
    Route::get('/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
    Route::get('/landlords', [AgentController::class, 'landlords'])->name('agent.landlords');
    Route::post('/landlord/{landlord}/request', [AgentController::class, 'requestLandlord'])->name('agent.landlord.request');
    
    // Property and tenant management for verified agents
    Route::get('/properties', [AgentController::class, 'properties'])->name('agent.properties');
    Route::get('/property/{property}/tenants', [AgentController::class, 'propertyTenants'])->name('agent.property.tenants');
    Route::get('/tenant/search', [AgentController::class, 'searchTenants'])->name('agent.tenant.search');
    Route::post('/tenant/{tenant}/add-to-property/{property}', [AgentController::class, 'addTenantToProperty'])->name('agent.tenant.add');
    
    // Review management for agents
    Route::get('/reviews', [AgentController::class, 'reviews'])->name('agent.reviews');
    Route::post('/tenant/{tenant}/review', [ReviewController::class, 'storeAgentReview'])->name('agent.review.store');
    Route::get('/reviews/pending', [AgentController::class, 'pendingReviews'])->name('agent.reviews.pending');
    Route::get('/reviews/rejected', [AgentController::class, 'rejectedReviews'])->name('agent.reviews.rejected');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/landlords', [AdminController::class, 'landlords'])->name('admin.users.landlords');
    Route::get('/users/agents', [AdminController::class, 'agents'])->name('admin.users.agents');
    Route::get('/users/tenants', [AdminController::class, 'tenants'])->name('admin.users.tenants');
    Route::get('/user/{user}/edit', [AdminController::class, 'editUser'])->name('admin.user.edit');
    Route::put('/user/{user}', [AdminController::class, 'updateUser'])->name('admin.user.update');
    Route::delete('/user/{user}', [AdminController::class, 'destroyUser'])->name('admin.user.destroy');
    
    // Verification management
    Route::get('/verifications', [AdminController::class, 'verifications'])->name('admin.verifications');
    Route::post('/verification/{verification}/approve', [VerificationController::class, 'approve'])->name('admin.verification.approve');
    Route::post('/verification/{verification}/reject', [VerificationController::class, 'reject'])->name('admin.verification.reject');
    
    // Document verification
    Route::get('/documents', [AdminController::class, 'documents'])->name('admin.documents');
    Route::post('/document/{document}/verify', [DocumentController::class, 'verify'])->name('admin.document.verify');
    Route::post('/document/{document}/reject', [DocumentController::class, 'reject'])->name('admin.document.reject');
    
    // Badge verification
    Route::get('/badge/requests', [AdminController::class, 'badgeRequests'])->name('admin.badge.requests');
    Route::post('/badge/request/{request}/approve', [AdminController::class, 'approveBadge'])->name('admin.badge.approve');
    Route::post('/badge/request/{request}/reject', [AdminController::class, 'rejectBadge'])->name('admin.badge.reject');
    
    // Review dispute management
    Route::get('/reviews/disputes', [AdminController::class, 'reviewDisputes'])->name('admin.reviews.disputes');
    Route::post('/dispute/{dispute}/resolve', [ReviewController::class, 'resolveDispute'])->name('admin.dispute.resolve');
    
    // Analytics
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
});

// Common Routes
Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');
    Route::put('/password/change', [HomeController::class, 'changePassword'])->name('password.change');
    
    // Document Upload Routes
    Route::post('/documents/upload', [DocumentController::class, 'upload'])->name('documents.upload');
    Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    
    // Verification Request Routes
    Route::post('/verification/request', [VerificationController::class, 'requestVerification'])->name('verification.request');
});
