<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\ShiftChange;

class ShiftChangeController extends Controller
{
    // Function to store shift change requests
    public function store(Request $request)
    {
        // Validate input
$request->validate([
    'schedule_id' => 'nullable|exists:schedules,id', // Now it's optional
    'shiftdate' => 'required|date',
    'starttime' => 'required',
    'endtime' => 'required',
    'shifttype' => 'required|string',
    'request_reason' => 'required|string',
]);

        // Create a new shift change request
        ShiftChange::create([
            'schedule_id' => $request->schedule_id,
            'shiftdate' => $request->shiftdate,
            'starttime' => $request->starttime,
            'endtime' => $request->endtime,
            'shifttype' => $request->shifttype,
            'request_reason' => $request->request_reason,
            'status' => 'Pending',
        ]);

        return redirect()->route('schedules.index')->with('success', 'Shift change request submitted.');
    }

    // Function to show the shift change request form
    public function create()
    {
        $schedule = new Schedule(); // Ensure schedule object exists
        return view('schedules.create', compact('schedule'));
    }

    // Function to approve a shift change request
    public function approveChange(Schedule $schedule)
    {
        $schedule->update([
            'shift_status' => 'Approved',
            'approved_by' => Auth::id(),
            'requested_shift_id' => null,
        ]);

        return redirect()->route('schedules.index')->with('success', '✅ Shift change approved.');
    }

    // Function to deny a shift change request
    public function denyChange(Schedule $schedule)
    {
        $schedule->update(['shift_status' => 'Denied']);

        return redirect()->route('schedules.index')->with('error', '❌ Shift change request denied.');
    }
}
