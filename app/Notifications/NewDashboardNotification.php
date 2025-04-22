<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage; // if using Nexmo for SMS

class NewDashboardNotification extends Notification
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    // Determine channels based on user preferences
    public function via($notifiable)
    {
        $channels = ['database']; // Always log to the database

        if ($notifiable->email_notifications) {
            $channels[] = 'mail';
        }
        if ($notifiable->sms_notifications) {
            $channels[] = 'nexmo'; // Or 'twilio', if that's what you're using
        }

        return $channels;
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->data['message'],
            'link'    => $this->data['link'],
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Notification')
                    ->line($this->data['message'])
                    ->action('View Notification', url($this->data['link']))
                    ->line('Thank you for using SmartCare!');
    }

    public function toNexmo($notifiable)
    {
        return (new NexmoMessage)
                    ->content($this->data['message'] . ' View here: ' . url($this->data['link']));
    }
}
