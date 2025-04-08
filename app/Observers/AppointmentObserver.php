<?php

namespace App\Observers;

use App\Models\Appointment;
use App\Models\Notification as CustomNotification; // your custom notification log model
use App\Mail\NewAppointmentNotification;
use Illuminate\Support\Facades\Mail;

class AppointmentObserver
{
    public function created(Appointment $appointment)
    {
        // Get the resident linked to this appointment.
        $resident = $appointment->resident;
        if (!$resident) {
            return; // No resident linked – nothing to do.
        }

        // Retrieve the resident's next-of-kin.
        $nextOfKins = $resident->nextOfKin;  // This might be a Collection.

        if ($nextOfKins && $nextOfKins->isNotEmpty()) {
            foreach ($nextOfKins as $nextOfKin) {
                // Log the notification record.
                CustomNotification::create([
                    'nextofkin_id' => $nextOfKin->id,
                    'message'      => 'A new appointment has been scheduled for ' . $resident->full_name . ': ' . $appointment->reason,
                    'is_new'       => true,
                ]);

                // Send an email if enabled.
                if ($nextOfKin->email_notifications) {
                    Mail::to($nextOfKin->email)->send(new NewAppointmentNotification($appointment));
                }
            }
        }
    }
}
