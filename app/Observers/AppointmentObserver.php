<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\Notification;
use App\Models\NextOfKin;

class AppointmentObserver
{
    /**
     * Handle the Appointment "created" event.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return void
     */
    public function created(Appointment $appointment)
    {
        // Find all next-of-kin records linked to the resident for which this appointment was created.
        $nextOfKins = NextOfKin::where('residentid', $appointment->residentid)->get();

        foreach ($nextOfKins as $nextOfKin) {
            Notification::create([
                'nextofkin_id' => $nextOfKin->id,
                'message'      => 'A new appointment has been scheduled for your resident: ' . $appointment->title,
                'is_new'       => true,
                // Add any additional fields as needed.
            ]);
        }
    }
}
