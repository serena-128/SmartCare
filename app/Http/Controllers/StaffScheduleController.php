<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Schedule;

class StaffScheduleController extends Controller
{
    public function showSchedule()
    {
        // Fetch the schedule data (you can adjust this query based on your requirements)
        $scheduleData = Schedule::where('staff_id', auth()->user()->id)->get();

        // Return the view from the staffmembers folder
        return view('staffmembers.schedule', compact('scheduleData')); // The view is now in the staffmembers folder
    }
}
