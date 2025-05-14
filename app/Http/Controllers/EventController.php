<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

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
        // Fetch events from the 'events' table
        $events = DB::table('events')
            ->select('id','title', DB::raw("start_date as start"), 'description')
            ->get();

        return response()->json($events);
    }
    public function handleRSVP(Request $request)
{
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'nextofkin_id' => 'required|exists:nextofkin,id',
        'rsvp_status' => 'required|in:yes,no'
    ]);

    try {
        // Store the RSVP in your database
        // Fetch event and next of kin
$event = Event::find($validated['event_id']);
$nextofkin = DB::table('nextofkin')->where('id', $validated['nextofkin_id'])->first();

DB::table('event_rsvps')->updateOrInsert(
    [
        'event_id' => $validated['event_id'],
        'nextofkin_id' => $validated['nextofkin_id']
    ],
    [
        'status' => $validated['rsvp_status'],
        'event_title' => $event->title ?? null,
        'nextofkin_name' => $nextofkin ? trim($nextofkin->firstname . ' ' . $nextofkin->lastname) : null,
        'created_at' => now(),
        'updated_at' => now()
    ]
);


        return response()->json([
            'success' => true,
            'message' => 'RSVP recorded successfully'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to record RSVP: ' . $e->getMessage()
        ], 500);
    }
}
  
    public function getRSVPStatus($eventId)
{
    $nextOfKinId = auth()->guard('nextofkin')->id();
    
    $rsvp = DB::table('event_rsvps')
        ->where('event_id', $eventId)
        ->where('nextofkin_id', $nextOfKinId)
        ->first();

    return response()->json([
        'status' => $rsvp->status ?? null
    ]);
}

}
