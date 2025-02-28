<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rsvp;

class RsvpController extends Controller
{
    public function showForm()
    {
        return view('rsvp-form');
    }

    public function submitRsvp(Request $request)
    {
        $request->validate([
            'event_id' => 'required|in:1,2',
        ]);

        $rsvp = new Rsvp();
        $rsvp->event_id = $request->event_id;
        $rsvp->user_id = auth()->id();
        $rsvp->save();

        return redirect()->route('rsvp.form')->with('success', 'Your RSVP has been submitted!');
    }
}
