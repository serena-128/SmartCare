<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Staffmember;
use App\Models\EmergencyAlert;
use App\Models\CarePlan;
use Illuminate\Support\Facades\Auth; // Ensure Auth is imported

class DashboardController extends Controller
{
    public function index()
    {
        // Ensure Mark Reily (staff_id = 2) is logged in
        $staffId = auth()->user()->staff_id ?? 2;  // Default to 2 for testing

        // Fetch residents assigned to the logged-in staff member
        $assignedResidents = Resident::where('assigned_staff_id', $staffId)->get();

        return view('staffDashboard', [ // Updated to 'staffDashboard'
            'residentCount' => Resident::count(),
            'staffCount' => Staffmember::count(),
            'emergencyAlertCount' => EmergencyAlert::where('status', 'Pending')->count(),
            'carePlanCount' => CarePlan::count(),
            'recentAlerts' => EmergencyAlert::latest()->take(5)->get(),
            'onDutyStaff' => Staffmember::where('staff_role', 'LIKE', '%Nurse%')->get(),
            'assignedResidents' => $assignedResidents, // Pass assigned residents to the view
            'carePlans' => CarePlan::with('resident')->get() // Fetch care plans with resident details
        ]);
    }
}
