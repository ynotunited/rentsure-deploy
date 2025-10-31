<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\VerificationRequest;

class VerificationStatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    protected $verification;
    protected $status;

    public function __construct(VerificationRequest $verification, $status)
    {
        $this->verification = $verification;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $subject = $this->status === 'approved' 
            ? 'Verification Approved - RentSure' 
            : 'Verification Update - RentSure';

        $greeting = $this->status === 'approved' 
            ? 'Congratulations ' . $notifiable->name . '! ✅' 
            : 'Hello ' . $notifiable->name . '! 📋';

        $message = (new MailMessage)
            ->subject($subject)
            ->greeting($greeting);

        if ($this->status === 'approved') {
            $message->line('Your verification request has been approved!')
                   ->line('You are now a verified user on RentSure.')
                   ->line('**Verification Type:** ' . ucfirst($this->verification->type))
                   ->line('**Approved On:** ' . now()->format('F j, Y'))
                   ->action('Access Your Dashboard', url('/dashboard'))
                   ->line('As a verified user, you now have access to:')
                   ->line('• Enhanced profile visibility')
                   ->line('• Priority in property listings')
                   ->line('• Increased trust from other users')
                   ->line('• Access to premium features');
        } elseif ($this->status === 'rejected') {
            $message->line('We regret to inform you that your verification request has been rejected.')
                   ->line('**Verification Type:** ' . ucfirst($this->verification->type))
                   ->line('**Reason:** ' . ($this->verification->rejection_reason ?? 'Documents did not meet our requirements'))
                   ->action('Submit New Request', url('/verification/new'))
                   ->line('You can submit a new verification request with updated documents.')
                   ->line('Please ensure all documents are clear, valid, and meet our requirements.');
        } else {
            $message->line('Your verification request status has been updated.')
                   ->line('**Status:** ' . ucfirst($this->status))
                   ->line('**Verification Type:** ' . ucfirst($this->verification->type))
                   ->action('Check Status', url('/verification/status'))
                   ->line('We will notify you of any further updates.');
        }

        return $message->salutation('Best regards, The RentSure Team 🇳🇬');
    }
}
