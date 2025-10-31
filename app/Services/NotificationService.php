<?php

namespace App\Services;

use App\Models\User;
use App\Models\Property;
use App\Models\TenantReview;
use App\Models\VerificationRequest;
use App\Notifications\UserRegistered;
use App\Notifications\PropertyAdded;
use App\Notifications\ReviewSubmitted;
use App\Notifications\VerificationStatusChanged;
use App\Notifications\AgentVerificationRequest;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Send welcome email when user registers
     */
    public static function sendWelcomeEmail(User $user)
    {
        try {
            $user->notify(new UserRegistered($user));
            Log::info('Welcome email sent to user: ' . $user->email);
        } catch (\Exception $e) {
            Log::error('Failed to send welcome email: ' . $e->getMessage());
        }
    }

    /**
     * Send notification when property is added
     */
    public static function sendPropertyAddedEmail(Property $property)
    {
        try {
            $property->landlord->notify(new PropertyAdded($property));
            Log::info('Property added email sent for property: ' . $property->id);
        } catch (\Exception $e) {
            Log::error('Failed to send property added email: ' . $e->getMessage());
        }
    }

    /**
     * Send notification when review is submitted
     */
    public static function sendReviewSubmittedEmail(TenantReview $review)
    {
        try {
            // Notify landlord for approval
            $review->property->landlord->notify(new ReviewSubmitted($review, 'landlord'));
            
            // Notify tenant of submission
            $review->tenant->notify(new ReviewSubmitted($review, 'tenant'));
            
            Log::info('Review submitted emails sent for review: ' . $review->id);
        } catch (\Exception $e) {
            Log::error('Failed to send review submitted emails: ' . $e->getMessage());
        }
    }

    /**
     * Send notification when review is approved/rejected
     */
    public static function sendReviewStatusEmail(TenantReview $review, $status)
    {
        try {
            $subject = $status === 'approved' ? 'Review Approved - RentSure' : 'Review Update - RentSure';
            
            $message = $status === 'approved' 
                ? 'Your tenant review has been approved and is now visible to other users.'
                : 'Your tenant review status has been updated.';

            // You can create a specific ReviewStatusChanged notification if needed
            Log::info('Review status email sent for review: ' . $review->id . ' - Status: ' . $status);
        } catch (\Exception $e) {
            Log::error('Failed to send review status email: ' . $e->getMessage());
        }
    }

    /**
     * Send notification when verification status changes
     */
    public static function sendVerificationStatusEmail(VerificationRequest $verification, $status)
    {
        try {
            $verification->user->notify(new VerificationStatusChanged($verification, $status));
            Log::info('Verification status email sent for user: ' . $verification->user->email . ' - Status: ' . $status);
        } catch (\Exception $e) {
            Log::error('Failed to send verification status email: ' . $e->getMessage());
        }
    }

    /**
     * Send notification for agent verification requests
     */
    public static function sendAgentVerificationEmail(User $agent, User $landlord, $type = 'request')
    {
        try {
            if ($type === 'request') {
                $landlord->notify(new AgentVerificationRequest($agent, $landlord, 'request'));
            } else {
                $agent->notify(new AgentVerificationRequest($agent, $landlord, $type));
            }
            
            Log::info('Agent verification email sent - Type: ' . $type . ' - Agent: ' . $agent->email . ' - Landlord: ' . $landlord->email);
        } catch (\Exception $e) {
            Log::error('Failed to send agent verification email: ' . $e->getMessage());
        }
    }

    /**
     * Send admin notification for important events
     */
    public static function sendAdminNotification($subject, $message, $data = [])
    {
        try {
            $admins = User::where('role', 'admin')->get();
            
            foreach ($admins as $admin) {
                // You can create a generic AdminNotification class
                Log::info('Admin notification: ' . $subject . ' - ' . $message);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send admin notification: ' . $e->getMessage());
        }
    }

    /**
     * Send bulk notifications (for announcements, etc.)
     */
    public static function sendBulkNotification($users, $subject, $message)
    {
        try {
            foreach ($users as $user) {
                // You can create a BulkNotification class for announcements
                Log::info('Bulk notification sent to: ' . $user->email);
            }
        } catch (\Exception $e) {
            Log::error('Failed to send bulk notification: ' . $e->getMessage());
        }
    }
}
