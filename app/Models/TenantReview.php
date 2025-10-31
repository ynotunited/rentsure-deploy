<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantReview extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tenant_id', 'reviewer_id', 'property_id', 'rating', 'comment',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rating' => 'integer',
    ];

    /**
     * Get the tenant that was reviewed.
     */
    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    /**
     * Get the user who wrote the review (landlord or agent).
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Get the property associated with the review.
     */
    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the landlord who needs to approve this review.
     */
    public function landlord()
    {
        return $this->belongsTo(User::class, 'landlord_id');
    }

    /**
     * Check if review is pending approval.
     */
    public function isPendingApproval()
    {
        return $this->status === 'pending_approval';
    }

    /**
     * Check if review is approved.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if review is rejected.
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if review is disputed.
     */
    public function isDisputed()
    {
        return $this->status === 'disputed';
    }

    /**
     * Approve the review.
     */
    public function approve()
    {
        $this->status = 'approved';
        $this->public = true;
        return $this->save();
    }

    /**
     * Reject the review.
     */
    public function reject()
    {
        $this->status = 'rejected';
        $this->public = false;
        return $this->save();
    }

    /**
     * Dispute the review.
     */
    public function dispute()
    {
        $this->status = 'disputed';
        return $this->save();
    }
}
