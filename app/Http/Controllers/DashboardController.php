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
        // Use default staff ID (e.g. 2 = Mark Reilly) for dev/testing
        $staffId = auth()->user()->staff_id ?? 2;
    
        // Fetch residents assigned to the logged-in staff member
        $assignedResidents = Resident::where('assigned_staff_id', $staffId)->get();
    
        // ✅ FIX: Use $staffId to avoid error when auth is null
        $upcomingAppointments = \App\Models\Appointment::with('resident')
            ->where('staffmemberid', $staffId)
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get();
    
        return view('staffDashboard', [
            'residentCount' => Resident::count(),
            'staffCount' => Staffmember::count(),
            'emergencyAlertCount' => EmergencyAlert::where('status', 'Pending')->count(),
            'carePlanCount' => CarePlan::count(),
            'recentAlerts' => EmergencyAlert::latest()->take(5)->get(),
            'onDutyStaff' => Staffmember::where('staff_role', 'LIKE', '%Nurse%')->get(),
            'assignedResidents' => $assignedResidents,
            'carePlans' => CarePlan::with('resident')->get(),
    
            // ✅ Add this to pass upcoming appointments to the view
            'upcomingAppointments' => $upcomingAppointments,
        ]);
    }
    
}
