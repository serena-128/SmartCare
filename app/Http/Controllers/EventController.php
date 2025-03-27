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
            ->select('title', DB::raw("start_date as start"), 'description')
            ->get();

        return response()->json($events);
    }
}
