<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use App\Models\EventRsvp;
use Illuminate\Support\Facades\Auth;



class EventController extends Controller
{
    // ✅ Show the Add Event Form
    public function create()
    {
        return view('add_event_appointment'); // Ensure this Blade file exists
    }

    // ✅ Store the Event
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:event,appointment',
            'date' => 'required|date',
            'time' => 'nullable',
            'description' => 'nullable|string',
        ]);

        // Save event in the database
        Event::create($request->all());

        return redirect()->back()->with('success', 'Event/Appointment added successfully!');
    }
   public function fetchEvents()
{
    $events = DB::table('events')
        ->select('id', 'title', DB::raw("start_date as start"), 'description')
        ->get();

    return response()->json($events);
}

public function rsvp($id)
{
    $user = Auth::guard('nextofkin')->user(); // using 'nextofkin' guard

    // Check if already RSVPed
    $alreadyRsvped = EventRsvp::where('event_id', $id)
        ->where('nextofkin_id', $user->id)
        ->exists();

    if ($alreadyRsvped) {
        return response()->json([
            'success' => false,
            'message' => 'You have already RSVPed to this event.'
        ]);
    }

    // Save RSVP
    EventRsvp::create([
        'event_id' => $id,
        'nextofkin_id' => $user->id,
        'event_title' => Event::findOrFail($id)->title,
        'nextofkin_name' => $user->firstname . ' ' . $user->lastname,
    ]);

    // Increment RSVP count
    Event::where('id', $id)->increment('rsvp_count');

    return response()->json(['success' => true]);
}

    public function unrsvp($id)
{
    $user = Auth::guard('nextofkin')->user();

    $rsvp = EventRsvp::where('event_id', $id)
        ->where('nextofkin_id', $user->id)
        ->first();

    if (!$rsvp) {
        return response()->json(['success' => false, 'message' => 'You have not RSVPed to this event.']);
    }

    $rsvp->delete();

    // Decrement RSVP count
    Event::where('id', $id)->decrement('rsvp_count');

    return response()->json(['success' => true]);
}

}
