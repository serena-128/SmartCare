<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\StaffMember;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shifts = Shift::with('staffMember')->orderBy('shift_date')->get();
        $staff = StaffMember::all();
        return view('shifts.index', compact('shifts', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'staff_member_id' => 'required|exists:staffmember,id',
            'shift_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|after:start_time',
        ]);

        $hasConflict = Shift::where('staff_member_id', $request->staff_member_id)
            ->where('shift_date', $request->shift_date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $request->end_time);
                      });
            })->exists();

        if ($hasConflict) {
            return back()->with('error', 'This staff member already has a shift that overlaps this time.');
        }

        Shift::create($request->all());

        return redirect()->back()->with('success', 'Shift assigned successfully!');
    }

    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        $staff = StaffMember::all();
        return view('shifts.edit', compact('shift', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'staff_member_id' => 'required|exists:staffmember,id',
            'shift_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|after:start_time',
        ]);

        $shift = Shift::findOrFail($id);
        $shift->update($request->all());

        return redirect()->route('shifts.index')->with('success', 'Shift updated successfully!');
    }
}
