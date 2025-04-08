<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Notification as CustomNotification;
use App\Models\NextOfKin;
use App\Mail\NewEventNotification;
use Illuminate\Support\Facades\Mail;

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
        // Retrieve all next-of-kin (or you can filter them as needed).
        $nextOfKins = NextOfKin::all();

        foreach ($nextOfKins as $nextOfKin) {
            // Insert a record into your custom notifications table (if you use one)
            CustomNotification::create([
                'nextofkin_id' => $nextOfKin->id,
                'message'      => 'A new event has been added: ' . $event->title,
                'is_new'       => true,
            ]);

            // Send an email notification if enabled.
            if ($nextOfKin->email_notifications) {
                Mail::to($nextOfKin->email)->send(new NewEventNotification($event));
            }
        }
    }
}
