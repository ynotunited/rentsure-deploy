<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class UserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to RentSure - Your Account is Ready!')
            ->greeting('Welcome to RentSure, ' . $this->user->name . '! 🏠')
            ->line('Thank you for joining RentSure, Nigeria\'s trusted rental platform.')
            ->line('Your account has been successfully created with the following details:')
            ->line('**Name:** ' . $this->user->name)
            ->line('**Email:** ' . $this->user->email)
            ->line('**Role:** ' . ucfirst($this->user->role))
            ->line('**State:** ' . $this->user->state)
            ->action('Access Your Dashboard', url('/dashboard'))
            ->line('Next steps:')
            ->line('• Complete your profile verification')
            ->line('• Upload required documents')
            ->line('• Start connecting with verified users')
            ->line('If you have any questions, our support team is here to help.')
            ->salutation('Best regards, The RentSure Team 🇳🇬');
    }
}
