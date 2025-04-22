<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentRsvp extends Model
{
    use HasFactory, SoftDeletes;

    // Specify the table name if it doesn't follow Laravel's plural naming convention
    protected $table = 'appointment_rsvps';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'appointment_id',
        'nextofkin_id',
        'rsvp_status', // e.g., yes, no, maybe
        'comments'
    ];

    /**
     * Get the appointment associated with this RSVP.
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    /**
     * Get the next of kin who submitted this RSVP.
     */
    public function nextofkin()
    {
        return $this->belongsTo(NextOfKin::class, 'nextofkin_id');
    }
        public function rsvpSubmit(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointment,id',
            'rsvp_status'    => 'required|in:yes,no,maybe',
            'comments'       => 'nullable|string',
        ]);

        // Get the logged-in next-of-kin
        $nextOfKin = Auth::guard('nextofkin')->user();

        // Optionally, check if the appointment belongs to the next-of-kin's resident
        $appointment = \App\Models\Appointment::findOrFail($request->appointment_id);
        if ($appointment->residentid !== $nextOfKin->residentid) {
            return redirect()->back()->with('error', 'You are not authorized to RSVP for this appointment.');
        }

        // Create the RSVP
        \App\Models\AppointmentRsvp::updateOrCreate(
    [
        'appointment_id' => $appointment->id,
        'nextofkin_id'   => $nextOfKin->id,
    ],
    [
        'rsvp_status'    => $request->rsvp_status,
        'comments'       => $request->comments,
    ]
);


        return redirect()->route('appointments.rsvp.form')->with('success', 'RSVP submitted successfully.');
    }
}
