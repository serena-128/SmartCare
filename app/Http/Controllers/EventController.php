<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller {
    // Fetch events for the calendar
    public function getEvents() {
        $events = Event::all();
        return response()->json($events);
    }

    // Handle RSVP
    public function rsvp($id) {
        $event = Event::findOrFail($id);
        $event->increment('rsvp_count');

        return response()->json(['message' => 'RSVP Successful!', 'rsvp_count' => $event->rsvp_count]);
    }
}

}

