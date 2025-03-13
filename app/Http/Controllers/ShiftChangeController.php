<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftChangeController extends Controller
{
public function store(Request $request)
{
    $request->validate([
        'schedule_id' => 'required|exists:schedules,id',
        'new_shift_id' => 'required|exists:schedules,id',
        'request_reason' => 'required|string',
    ]);

    ShiftChange::create([
        'schedule_id' => $request->schedule_id,
        'requested_shift_id' => $request->new_shift_id,
        'request_reason' => $request->request_reason,
        'status' => 'Pending',
    ]);

    return redirect()->route('schedules.index')->with('success', 'Shift change request submitted.');
}
public function create()
{
    $schedule = new \App\Models\Schedule();
    return view('schedules.create', compact('schedule'));
}

    public function approveChange(Schedule $schedule)
    {
        $schedule->update([
            'shift_status' => 'Approved',
            'approved_by' => Auth::id(),
            'requested_shift_id' => null,
        ]);

        return redirect()->route('schedules.index')->with('success', '✅ Shift change approved.');
    }

    public function denyChange(Schedule $schedule)
    {
        $schedule->update(['shift_status' => 'Denied']);

        return redirect()->route('schedules.index')->with('error', '❌ Shift change request denied.');
    }
}
