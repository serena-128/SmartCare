<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Staffmember;
use App\Models\EmergencyAlert;
use App\Models\CarePlan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $staffId = session('staff_id'); // ✅ Use session directly

    // Fetch assigned residents
    $assignedResidents = \App\Models\Resident::where('assigned_staff_id', $staffId)->get();

    // Fetch care plans
    $carePlans = \App\Models\CarePlan::with('resident')->get();

    // Upcoming appointments
    $upcomingAppointments = \App\Models\Appointment::with('resident')
        ->where('staffmemberid', $staffId)
        ->whereBetween('date', [now()->toDateString(), now()->addDays(7)->toDateString()])
        ->orderBy('date')
        ->get();

    return view('staffDashboard', [
        'residentCount' => \App\Models\Resident::count(),
        'staffCount' => \App\Models\Staffmember::count(),
        'emergencyAlertCount' => \App\Models\EmergencyAlert::where('status', 'Pending')->count(),
        'carePlanCount' => \App\Models\CarePlan::count(),
        'recentAlerts' => \App\Models\EmergencyAlert::latest()->take(5)->get(),
        'onDutyStaff' => Staffmember::whereIn('role', ['Nurse', 'Doctor'])->get(),

        'assignedResidents' => $assignedResidents,
        'carePlans' => $carePlans,
        'upcomingAppointments' => $upcomingAppointments,
    ]);
}
    public function calendarView()
{
    $currentMonth = Carbon::now()->format('Y-m'); // or any month you want to display

    return view('staff.calendar', compact('currentMonth'));
}


}
