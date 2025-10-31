<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\TenantReview;

class ReviewSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    protected $review;
    protected $type; // 'landlord' or 'tenant'

    public function __construct(TenantReview $review, $type = 'landlord')
    {
        $this->review = $review;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if ($this->type === 'landlord') {
            return $this->toLandlordMail($notifiable);
        } else {
            return $this->toTenantMail($notifiable);
        }
    }

    private function toLandlordMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Tenant Review Requires Your Approval - RentSure')
            ->greeting('Hello ' . $notifiable->name . '! 📝')
            ->line('A new tenant review has been submitted and requires your approval.')
            ->line('**Review Details:**')
            ->line('**Tenant:** ' . $this->review->tenant->name)
            ->line('**Property:** ' . $this->review->property->title)
            ->line('**Rating:** ' . $this->review->rating . '/5 stars')
            ->line('**Review:** ' . substr($this->review->review_text, 0, 100) . '...')
            ->action('Review & Approve', url('/landlord/reviews/' . $this->review->id))
            ->line('Please review this submission and approve or reject it within 7 days.')
            ->line('Approved reviews help build trust in the RentSure community.')
            ->salutation('Best regards, The RentSure Team 🇳🇬');
    }

    private function toTenantMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Review Has Been Submitted - RentSure')
            ->greeting('Hello ' . $notifiable->name . '! 📝')
            ->line('Thank you for submitting your tenant review.')
            ->line('**Review Details:**')
            ->line('**Property:** ' . $this->review->property->title)
            ->line('**Rating:** ' . $this->review->rating . '/5 stars')
            ->line('Your review has been sent to the landlord for approval.')
            ->line('Once approved, it will be visible to other users on the platform.')
            ->action('View Your Reviews', url('/tenant/reviews'))
            ->line('Thank you for helping build a trustworthy rental community in Nigeria.')
            ->salutation('Best regards, The RentSure Team 🇳🇬');
    }
}
