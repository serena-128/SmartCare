<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;

class StaffShiftController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Assuming the user has a staffmember_id column linked to staff table
        $staffId = $user->staffmember_id ?? null;

        if (!$staffId) {
            return back()->with('error', 'No staff record linked to this user.');
        }

        // Get all shifts for this staff member
        $shifts = Shift::where('staff_member_id', $staffId)
            ->orderBy('shift_date')
            ->get();

        // Load the view and pass shifts
        return view('staff.shifts.index', compact('shifts'));
    }
}
