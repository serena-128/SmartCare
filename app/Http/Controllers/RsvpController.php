<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Ensure you have an Event model
use App\Models\EventRsvp; // Add this if you created an EventRsvp model
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class RsvpController extends Controller
{
    /**
     * Show the RSVP form with future events.
     */
    public function showForm()
    {
        // Fetch events with a start_date greater than now
        $futureEvents = Event::where('start_date', '>', Carbon::now())->get();

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

        // Increase the rsvp_count
        $event->increment('rsvp_count');

        // Retrieve the authenticated Next-of-Kin (assuming they have firstname and lastname fields)
        $nextOfKin = Auth::guard('nextofkin')->user();
        $nextofkinName = trim($nextOfKin->firstname . ' ' . $nextOfKin->lastname);

        // Create a new RSVP record including the event title and Next-of-Kin's name
        EventRsvp::create([
            'event_id'      => $event->id,
            'nextofkin_id'  => $nextOfKin->id,
            'event_title'   => $event->title,
            'nextofkin_name'=> $nextofkinName,
        ]);

        return redirect()->back()->with('success', 'RSVP submitted successfully.');
    }

}
