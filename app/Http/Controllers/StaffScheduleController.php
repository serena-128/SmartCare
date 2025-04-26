<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class StaffScheduleController extends Controller
{
    public function index()
{
    $staffId = session('staff_id');

    $schedules = \App\Models\Schedule::where('staffmemberid', $staffId)
        ->where('shift_status', 'approved')
        ->whereDate('shiftdate', '>=', now()) // ✅ Only from TODAY
        ->whereDate('shiftdate', '<=', now()->addMonth()) // ✅ Only up to 1 month ahead
        ->with('staff')
        ->orderBy('shiftdate')
        ->get();

    return view('staff.schedule', compact('schedules'));
}
public function getAvailableShifts(Request $request)
{
    $date = $request->query('date');

    $startOfWeek = \Carbon\Carbon::parse($date)->startOfWeek();
    $endOfWeek = \Carbon\Carbon::parse($date)->endOfWeek();

    $availableShifts = \App\Models\Schedule::whereNull('staffmemberid')
        ->where('shifttype', 'shift')
        ->whereBetween('shiftdate', [$startOfWeek, $endOfWeek])
        ->where('shift_status', 'approved')
        ->orderBy('shiftdate')
        ->get()
        ->map(function($shift) {
            return [
                'id' => $shift->id,
                'date' => \Carbon\Carbon::parse($shift->shiftdate)->format('D d M'),
                'start' => \Carbon\Carbon::parse($shift->starttime)->format('H:i'),
                'end' => \Carbon\Carbon::parse($shift->endtime)->format('H:i')
            ];
        });

    return response()->json($availableShifts);
}

}
