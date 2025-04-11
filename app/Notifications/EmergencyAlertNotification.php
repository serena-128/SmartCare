<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;
use App\Models\EmergencyAlert;

class EmergencyAlertNotification extends Notification
{
    use Queueable;

    protected $alert;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\EmergencyAlert $alert
     */
    public function __construct(EmergencyAlert $alert)
    {
        $this->alert = $alert;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // switch from mail to database
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'alert_id'     => $this->alert->id,
            'resident'     => $this->alert->resident->firstname ?? 'Unknown',
            'type'         => $this->alert->alerttype,
            'urgency'      => $this->alert->urgency,
            'details'      => $this->alert->details,
            'timestamp'    => $this->alert->alerttimestamp,
        ];
    }
}
