<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\Notification;
use App\Models\NextOfKin; // This should correspond to your next-of-kin table/model

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
    $nextOfKins = \App\Models\NextOfKin::all();

    foreach ($nextOfKins as $nextOfKin) {
        \App\Models\Notification::create([
            'nextofkin_id' => $nextOfKin->id, // Use the correct column name here
            'message' => 'A new event has been added: ' . $event->title,
            'is_new'  => true,
            // Add any additional fields required by your notifications table
        ]);
    }
}

}
