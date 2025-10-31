<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 'original_name', 'file_path', 'file_size', 'mime_type', 'status', 'admin_notes', 'approved_at', 'approved_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'approved_at' => 'datetime',
    ];

    /**
     * Get the user that owns the document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin who approved this document.
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Check if document is approved.
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if document is pending.
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Approve the document.
     */
    public function approve($adminId, $notes = null)
    {
        $this->status = 'approved';
        $this->approved_by = $adminId;
        $this->approved_at = now();
        $this->admin_notes = $notes;
        return $this->save();
    }

    /**
     * Reject the document.
     */
    public function reject($adminId, $notes = null)
    {
        $this->status = 'rejected';
        $this->approved_by = $adminId;
        $this->admin_notes = $notes;
        return $this->save();
    }
}
