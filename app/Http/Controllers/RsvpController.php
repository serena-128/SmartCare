<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
    // Display the RSVP form
    public function showForm()
    {
        return view('rsvp-form');  // Make sure this view exists
    }

    // Handle form submission
    public function submitRsvp(Request $request)
    {
        // Validate input
        $request->validate([
            'event_id' => 'required|exists:events,id',  // Assuming you have an events table
        ]);

        // Create the RSVP record
        $rsvp = new Rsvp();
        $rsvp->event_id = $request->event_id;
        $rsvp->user_id = auth()->id();  // Assuming you're using user authentication
        $rsvp->save();

        // Redirect back with a success message
        return redirect()->route('rsvp.form')->with('success', 'Your RSVP has been submitted!');
    }
}
