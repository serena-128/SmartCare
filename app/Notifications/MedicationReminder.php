<?php

namespace App\Notifications;

use App\Models\Resident;
use App\Models\Medication;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MedicationReminder extends Notification
{
    use Queueable;

    protected $resident;
    protected $medication;

    /**
     * Create a new notification instance.
     */
    public function __construct(Resident $resident, Medication $medication)
    {
        $this->resident = $resident;
        $this->medication = $medication;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Overdue Medication Reminder')
            ->line("⏰ The medication **{$this->medication->medication_name}** for resident **{$this->resident->full_name}** is overdue.")
            ->line("🗓️ Scheduled time: {$this->medication->scheduled_time}")
            ->action('Review Medication', url("/medications/{$this->medication->id}"))
            ->line('Please ensure the medication is administered as soon as possible.');
    }

    /**
     * Optional: Array representation for storage or broadcasting.
     */
    public function toArray($notifiable)
    {
        return [
            'resident_id' => $this->resident->id,
            'medication_id' => $this->medication->id,
            'scheduled_time' => $this->medication->scheduled_time,
            'message' => "Overdue medication for {$this->resident->full_name}: {$this->medication->medication_name}",
        ];
    }
}
