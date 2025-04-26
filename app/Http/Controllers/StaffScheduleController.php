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

}
