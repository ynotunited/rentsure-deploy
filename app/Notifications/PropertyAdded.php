<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Property;

class PropertyAdded extends Notification implements ShouldQueue
{
    use Queueable;

    protected $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Property Successfully Added - RentSure')
            ->greeting('Hello ' . $notifiable->name . '! 🏠')
            ->line('Your property has been successfully added to RentSure.')
            ->line('**Property Details:**')
            ->line('**Title:** ' . $this->property->title)
            ->line('**Type:** ' . ucfirst($this->property->type))
            ->line('**Location:** ' . $this->property->address . ', ' . $this->property->state)
            ->line('**Rent:** ₦' . number_format($this->property->rent_amount) . ' per ' . $this->property->rent_period)
            ->action('View Property', url('/properties/' . $this->property->id))
            ->line('Your property is now visible to verified tenants and agents on our platform.')
            ->line('You will receive notifications when tenants show interest or submit applications.')
            ->salutation('Best regards, The RentSure Team 🇳🇬');
    }
}
