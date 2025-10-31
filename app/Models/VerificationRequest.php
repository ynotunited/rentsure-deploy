<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status', 'notes', 'admin_notes', 'submitted_at', 'reviewed_at', 'reviewed_by',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Get the user that made the request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who reviewed the request.
     */
    public function reviewedBy()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Check if request is pending.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if request is under review.
     */
    public function isUnderReview()
    {
        return $this->status === 'under_review';
    }

    /**
     * Check if request is approved.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if request is rejected.
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Approve the verification request.
     */
    public function approve($adminId, $notes = null)
    {
        $this->status = 'approved';
        $this->reviewed_by = $adminId;
        $this->reviewed_at = now();
        
        if ($notes) {
            $this->admin_notes = $notes;
        }
        
        if ($this->save()) {
            // Grant verification badge to user
            $user = $this->user;
            $user->verification_badge = true;
            return $user->save();
        }
        
        return false;
    }

    /**
     * Reject the verification request.
     */
    public function reject($adminId, $notes = null)
    {
        $this->status = 'rejected';
        $this->reviewed_by = $adminId;
        $this->reviewed_at = now();
        
        if ($notes) {
            $this->admin_notes = $notes;
        }
        
        return $this->save();
    }

    /**
     * Mark as under review.
     */
    public function markUnderReview($adminId)
    {
        $this->status = 'under_review';
        $this->reviewed_by = $adminId;
        $this->reviewed_at = now();
        return $this->save();
    }
}
