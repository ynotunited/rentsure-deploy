<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone_number', 'nin', 'address', 'latitude', 'longitude', 'place_id', 'state', 'password', 'role', 'verified', 'verification_badge',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified' => 'boolean',
        'verification_badge' => 'boolean',
    ];

    /**
     * Get the latest verification request.
     */
    public function latestVerificationRequest()
    {
        return $this->hasOne(VerificationRequest::class)->latest();
    }

    /**
     * Check if user has a pending verification request.
     */
    public function hasPendingVerificationRequest()
    {
        return $this->verificationRequests()->where('status', 'pending')->exists();
    }

    /**
     * Get all properties owned by the landlord.
     */
    public function properties()
    {
        if ($this->role !== 'landlord') {
            return null;
        }
        
        return $this->hasMany(Property::class, 'landlord_id');
    }

    /**
     * Get properties where the user is a tenant.
     */
    public function tenantProperties()
    {
        if ($this->role !== 'tenant') {
            return null;
        }
        
        return $this->belongsToMany(Property::class, 'property_tenants', 'tenant_id', 'property_id')
                    ->withPivot('start_date', 'end_date', 'active')
                    ->withTimestamps();
    }

    /**
     * Get landlords associated with this agent.
     */
    public function landlords()
    {
        if ($this->role !== 'agent') {
            return null;
        }
        
        return $this->belongsToMany(User::class, 'agent_landlords', 'agent_id', 'landlord_id')
                    ->withPivot('verified')
                    ->withTimestamps();
    }

    /**
     * Get agents associated with this landlord.
     */
    public function agents()
    {
        if ($this->role !== 'landlord') {
            return null;
        }
        
        return $this->belongsToMany(User::class, 'agent_landlords', 'landlord_id', 'agent_id')
                    ->withPivot('verified')
                    ->withTimestamps();
    }

    /**
     * Get reviews received by the tenant.
     */
    public function receivedReviews()
    {
        if ($this->role !== 'tenant') {
            return null;
        }
        
        return $this->hasMany(TenantReview::class, 'tenant_id');
    }

    /**
     * Get reviews written by the user.
     */
    public function writtenReviews()
    {
        if (!in_array($this->role, ['landlord', 'agent'])) {
            return null;
        }
        
        return $this->hasMany(TenantReview::class, 'reviewer_id');
    }

    /**
     * Get documents uploaded by the user.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * Get verification requests made by the user.
     */
    public function verificationRequests()
    {
        return $this->hasMany(VerificationRequest::class);
    }

    /**
     * Check if the user is a landlord.
     */
    public function isLandlord()
    {
        return $this->role === 'landlord';
    }

    /**
     * Check if the user is an agent.
     */
    public function isAgent()
    {
        return $this->role === 'agent';
    }

    /**
     * Check if the user is a tenant.
     */
    public function isTenant()
    {
        return $this->role === 'tenant';
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
