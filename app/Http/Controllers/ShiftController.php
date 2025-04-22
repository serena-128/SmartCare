<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\StaffMember;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $staff = StaffMember::all();
        $shifts = Shift::with('staffMember')->orderBy('shift_date')->get();
        return view('shifts.index', compact('staff', 'shifts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_member_id' => 'required|exists:staffmember,id',
            'shift_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|after:start_time',
        ]);

        // Check for overlapping shifts
        $exists = Shift::where('staff_member_id', $request->staff_member_id)
            ->where('shift_date', $request->shift_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time]);
            })->exists();

        if ($exists) {
            return back()->with('error', 'This staff member already has a shift during this time.');
        }

        Shift::create($request->all());

        return redirect()->back()->with('success', 'Shift assigned successfully!');
    }
}
