<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Staffmember;
use App\Models\EmergencyAlert;
use App\Models\CarePlan;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function index()
    {
        // Get the logged-in staff member's ID
        $staffId = auth()->user()->id;  // Use the authenticated user's ID

        // Fetch residents assigned to the logged-in staff member
        $assignedResidents = Resident::where('assigned_staff_id', $staffId)->get();

        // Fetch care plans related to assigned residents
        $carePlans = CarePlan::with('resident')->get();

        // Return the dashboard view with necessary data
        return view('staffDashboard', [
            'residentCount' => Resident::count(),
            'staffCount' => Staffmember::count(),
            'emergencyAlertCount' => EmergencyAlert::where('status', 'Pending')->count(),
            'carePlanCount' => CarePlan::count(),
            'recentAlerts' => EmergencyAlert::latest()->take(5)->get(),
            'onDutyStaff' => Staffmember::where('staff_role', 'LIKE', '%Nurse%')->get(),
            'assignedResidents' => $assignedResidents, // Pass assigned residents to the view
            'carePlans' => $carePlans // Pass care plans to the view
        ]);
    }
    public function showDashboard()
{
    // Fetch all messages for the staff (either for all or the assigned caregiver)
    $messages = Message::where('recipient', 'all')
                        ->orWhere('recipient', 'caregiver')
                        ->where('caregiver_id', auth()->user()->id) // Only show if the staff is the caregiver
                        ->get();

    return view('staff.dashboard', compact('messages'));
}

}

