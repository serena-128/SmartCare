<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftChangeController extends Controller
{
public function requestChange(Request $request, Schedule $schedule)
{
    $request->validate([
        'requested_shift_id' => 'required|exists:schedule,id|different:schedule.id',
        'request_reason' => 'required|string|min:10',
    ]);

    $schedule->update([
        'requested_shift_id' => $request->requested_shift_id,
        'shift_status' => 'Pending Change',
        'request_reason' => $request->request_reason,
    ]);

    // ✅ Redirect to the confirmation page
    return redirect()->route('schedules.requestConfirmation');
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
