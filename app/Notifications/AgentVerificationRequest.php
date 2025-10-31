<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class AgentVerificationRequest extends Notification implements ShouldQueue
{
    use Queueable;

    protected $agent;
    protected $landlord;
    protected $type; // 'request' or 'approved' or 'rejected'

    public function __construct(User $agent, User $landlord, $type = 'request')
    {
        $this->agent = $agent;
        $this->landlord = $landlord;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if ($this->type === 'request') {
            return $this->requestMail($notifiable);
        } elseif ($this->type === 'approved') {
            return $this->approvedMail($notifiable);
        } else {
            return $this->rejectedMail($notifiable);
        }
    }

    private function requestMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Agent Verification Request - RentSure')
            ->greeting('Hello ' . $notifiable->name . '! 🤝')
            ->line('An agent has requested verification to manage your properties.')
            ->line('**Agent Details:**')
            ->line('**Name:** ' . $this->agent->name)
            ->line('**Email:** ' . $this->agent->email)
            ->line('**Phone:** ' . $this->agent->phone_number)
            ->line('**State:** ' . $this->agent->state)
            ->action('Review Agent Request', url('/landlord/agents/requests'))
            ->line('Please review their profile and credentials before making a decision.')
            ->line('Verified agents can help you manage properties and find quality tenants.')
            ->salutation('Best regards, The RentSure Team 🇳🇬');
    }

    private function approvedMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Agent Verification Approved - RentSure')
            ->greeting('Congratulations ' . $notifiable->name . '! ✅')
            ->line('Your agent verification request has been approved by ' . $this->landlord->name . '.')
            ->line('**Landlord:** ' . $this->landlord->name)
            ->line('**Location:** ' . $this->landlord->state)
            ->action('View Partnership', url('/agent/landlords'))
            ->line('You can now:')
            ->line('• Manage their properties')
            ->line('• List new properties on their behalf')
            ->line('• Screen and manage tenant applications')
            ->line('• Earn commissions on successful rentals')
            ->salutation('Best regards, The RentSure Team 🇳🇬');
    }

    private function rejectedMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Agent Verification Update - RentSure')
            ->greeting('Hello ' . $notifiable->name . '! 📋')
            ->line('Your agent verification request was not approved by ' . $this->landlord->name . '.')
            ->line('This may be due to various factors such as location, experience, or current needs.')
            ->action('Find Other Opportunities', url('/agent/landlords/search'))
            ->line('Don\'t worry! There are many other landlords looking for reliable agents.')
            ->line('Continue building your profile and applying to work with other landlords.')
            ->salutation('Best regards, The RentSure Team 🇳🇬');
    }
}
