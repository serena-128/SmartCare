<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Staffmember;
use App\Models\EmergencyAlert;
use App\Models\CarePlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Pharmacyorder;
use App\Models\Appointment;


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
        
        $upcomingAppointments = Appointment::with('resident')
            ->where('staffmemberid', $staffId)
            ->whereBetween('date', [now()->toDateString(), now()->addDays(7)->toDateString()])
            ->orderBy('date')
            ->get();



        // Return the dashboard view with necessary data
        return view('staffDashboard', [
            'residentCount' => Resident::count(),
            'staffCount' => Staffmember::count(),
            'emergencyAlertCount' => EmergencyAlert::where('status', 'Pending')->count(),
            'carePlanCount' => CarePlan::count(),
            'recentAlerts' => EmergencyAlert::latest()->take(5)->get(),
            'onDutyStaff' => Staffmember::where('staff_role', 'LIKE', '%Nurse%')->get(),
            'assignedResidents' => $assignedResidents, // Pass assigned residents to the view
            'carePlans' => $carePlans,// Pass care plans to the view
             'upcomingAppointments' => $upcomingAppointments
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
  

public function showMedicationInfo(Request $request)
{
    $drugName = $request->input('drugName');

    $response = Http::get('https://api.fda.gov/drug/label.json', [
        'search' => 'openfda.brand_name:' . $drugName,
        'limit' => 1
    ]);

    $drugData = $response->successful() && isset($response['results'][0])
        ? $response['results'][0]
        : null;

    // 🩺 Medication Center data
    $residents = Resident::all();
    $products = Product::all();
    $orders = PharmacyOrder::with('product')->get();

    return view('staff.medication', compact('drugName', 'drugData', 'residents', 'products', 'orders'));
}

    public function showMedicationPage(Request $request)
{
    $residents = Resident::all();
    $drugName = $request->query('drugName');
    $drugData = null;

    if ($drugName) {
        $response = Http::get('https://api.fda.gov/drug/label.json', [
            'search' => 'openfda.brand_name:' . $drugName,
            'limit' => 1
        ]);

        if ($response->successful() && isset($response['results'][0])) {
            $drugData = $response['results'][0];
        }
    }

    return view('staff.medications', compact('residents', 'drugData', 'drugName'));
}



}

