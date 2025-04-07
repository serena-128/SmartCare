<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Staffmember;
use App\Models\EmergencyAlert;
use App\Models\CarePlan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // ✅ Safely get the logged-in user's email or fallback
        $staffEmail = auth()->check() ? auth()->user()->email : 'emma.kavanagh@example.com';

        // ✅ Find the staff member by email
        $staff = Staffmember::where('email', $staffEmail)->first();
        $staffId = $staff ? $staff->id : null;

        // ✅ Upcoming Appointments for this staff
        $upcomingAppointments = \App\Models\Appointment::with('resident')
            ->where('staffmemberid', $staffId)
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get();

        // ✅ Assigned residents for this staff
        $assignedResidents = Resident::where('assigned_staff_id', $staffId)->get();

        return view('staffDashboard', [
            'residentCount' => Resident::count(),
            'staffCount' => Staffmember::count(),
            'emergencyAlertCount' => EmergencyAlert::where('status', 'Pending')->count(),
            'carePlanCount' => CarePlan::count(),
            'recentAlerts' => EmergencyAlert::latest()->take(5)->get(),
            'onDutyStaff' => Staffmember::where('staff_role', 'LIKE', '%Nurse%')->get(),
            'assignedResidents' => $assignedResidents,
            'carePlans' => CarePlan::with('resident')->get(),
            'upcomingAppointments' => $upcomingAppointments,
        ]);
    }
    public function calendarView()
{
    return view('staff.calendar');
}

}
