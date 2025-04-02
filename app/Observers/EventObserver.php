<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Notification;
use App\Models\NextOfKin; // Your next-of-kin model
use App\Mail\NewEventNotification; // Your Mailable for event notifications
use Illuminate\Support\Facades\Mail;
use Nexmo\Laravel\Facade\Nexmo; 

class EventObserver
{
    /**
     * Handle the Event "created" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function created(Event $event)
    {
        // Retrieve all next-of-kin users who need to be notified.
        $nextOfKins = NextOfKin::all();

        foreach ($nextOfKins as $nextOfKin) {
            // Insert notification record into your custom notifications table
            Notification::create([
                'nextofkin_id' => $nextOfKin->id, 
                'message'      => 'A new event has been added: ' . $event->title,
                'is_new'       => true,
                // Add any additional fields as required
            ]);

            // Send an email notification if enabled
            if ($nextOfKin->email_notifications) {
                Mail::to($nextOfKin->email)->send(new NewEventNotification($event));
            }

            // Send an SMS notification if enabled
            if ($nextOfKin->sms_notifications) {
                Nexmo::message()->send([
                    'to'   => $nextOfKin->contactnumber,
                    'from' => config('services.nexmo.sms_from'),
                    'text' => 'New event: ' . $event->title . '. View details: ' . route('events.show', $event->id),
                ]);
            }
        }
    }
}
