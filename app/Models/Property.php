<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'landlord_id', 'name', 'address', 'state', 'city', 'property_type', 'description',
    ];

    /**
     * Get the landlord that owns the property.
     */
    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    /**
     * Get the tenants for the property.
     */
    public function tenants()
    {
        return $this->belongsToMany(User::class, 'property_tenants', 'property_id', 'tenant_id')
                    ->withPivot('start_date', 'end_date', 'active', 'added_by')
                    ->withTimestamps();
    }

    /**
     * Get all reviews for tenants of this property.
     */
    public function reviews()
    {
        return $this->hasMany(TenantReview::class);
    }

    /**
     * Get active tenants for the property.
     */
    public function activeTenants()
    {
        return $this->belongsToMany(User::class, 'property_tenants', 'property_id', 'tenant_id')
                    ->wherePivot('active', true)
                    ->withPivot('start_date', 'end_date', 'active', 'added_by')
                    ->withTimestamps();
    }
}
