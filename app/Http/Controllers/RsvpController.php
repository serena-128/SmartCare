<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Make sure you have an Event model
use Carbon\Carbon;

class RsvpController extends Controller
{
    /**
     * Show the RSVP form with future events.
     */
    public function showForm()
    {
        // Fetch events with a date greater than today (assuming the event date is stored in the "date" column)
        $futureEvents = Event::where('start_date', '>', \Carbon\Carbon::now())->get();


        return view('rsvp.form', compact('futureEvents'));
    }

    /**
     * Handle RSVP form submission.
     */
    public function submitRsvp(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        // Retrieve the event
        $event = Event::findOrFail($request->event_id);

        // Increase the rsvp_count (make sure your events table has a column "rsvp_count")
        $event->increment('rsvp_count');

        // Optionally, record additional RSVP details in a separate table if needed

        return redirect()->back()->with('success', 'RSVP submitted successfully.');
    }
}