<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Staffmember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
{
    // Show the shift calendar
    public function index()
    {
        // Load shifts with staffmember relationship (removed role)
        $shifts = Schedule::with('staffmember')->whereNull('deleted_at')->get();
        return view('shifts.index', compact('shifts'));
    }

    // Show the form for creating a new shift
    public function create()
    {
        $staffmembers = Staffmember::all();
        return view('shifts.create', compact('staffmembers'));
    }

    // Store the new shift in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'staffmemberid' => 'required|exists:staffmembers,id', // Fixed table name
            'shiftdate' => 'required|date',
            'starttime' => 'required|date_format:H:i',
            'endtime' => 'required|date_format:H:i',
            'shifttype' => 'required|in:morning,afternoon,night,emergency',
        ]);

        Schedule::create($validated);

        return redirect()->route('shifts.index')->with('success', 'Shift created successfully');
    }

    // Approve a shift
    public function approve($id)
    {
        $shift = Schedule::findOrFail($id);
        $shift->update(['status' => 'approved']);

        return redirect()->route('shifts.index')->with('success', 'Shift approved');
    }

    // Show the form for editing a shift
    public function edit($id)
    {
        $shift = Schedule::findOrFail($id);
        $staffmembers = Staffmember::all();
        return view('shifts.edit', compact('shift', 'staffmembers'));
    }

    // Update the shift
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'staffmemberid' => 'required|exists:staffmembers,id', // Fixed table name
            'shiftdate' => 'required|date',
            'starttime' => 'required|date_format:H:i',
            'endtime' => 'required|date_format:H:i',
            'shifttype' => 'required|in:morning,afternoon,night,emergency',
        ]);

        $shift = Schedule::findOrFail($id);
        $shift->update($validated);

        return redirect()->route('shifts.index')->with('success', 'Shift updated successfully');
    }
}
