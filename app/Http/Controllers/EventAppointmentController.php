<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Appointment;
use App\Models\Resident;
use App\Models\Staffmember;
use Carbon\Carbon;

class EventAppointmentController extends Controller
{
    /**
     * Display the form to add an event or appointment.
     */
    public function create()
    {
        // Get residents and staff for the appointment dropdowns
        $residents = Resident::all();
        $staffmembers = Staffmember::all();
        
        return view('events.choose', compact('residents', 'staffmembers'));
    }

    /**
     * Handle the form submission for creating an event or an appointment.
     */
    public function store(Request $request)
    {
        $type = $request->input('type');

        if ($type === 'event') {
            $data = $request->validate([
                'event_title'       => 'required|string|max:255',
                'event_description' => 'nullable|string',
                'event_start_date'  => 'required|date',
                'event_end_date'    => 'nullable|date',
            ]);

            Event::create([
                'title'       => $data['event_title'],
                'description' => $data['event_description'] ?? null,
                'start_date'  => $data['event_start_date'],
                'end_date'    => $data['event_end_date'] ?? null,
                'rsvp_count'  => 0,
            ]);
        } elseif ($type === 'appointment') {
            $data = $request->validate([
                'resident_id'          => 'required|exists:resident,id',
                'staffmember_id'       => 'required|exists:staffmembers,id',
                'appointment_date'     => 'required|date',
                'appointment_time'     => 'required',
                'appointment_reason'   => 'nullable|string|max:255',
                'appointment_location' => 'nullable|string|max:255',
            ]);

            Appointment::create([
                'residentid'    => $data['resident_id'],
                'staffmemberid' => $data['staffmember_id'],
                'date'          => $data['appointment_date'],
                'time'          => $data['appointment_time'],
                'reason'        => $data['appointment_reason'] ?? null,
                'location'      => $data['appointment_location'] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Record added successfully.');
    }
}
