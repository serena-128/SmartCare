<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NextOfKin; // Import NextOfKin model
use App\Models\Resident; // Import Resident model

class NextOfKinDashboardController extends Controller
{
    /**
     * Display the dashboard for the logged-in Next-of-Kin.
     */
    public function index()
{
    // Get the authenticated next of kin
    $nextOfKin = Auth::guard('nextofkin')->user();

    if (!$nextOfKin) {
        return redirect()->route('nextofkin.login')->with('error', 'Please log in first.');
    }

    // Fetch the resident assigned to this Next-of-Kin
    $resident = Resident::find($nextOfKin->residentid);

    // Ensure $resident is not undefined
    if (!$resident) {
        $resident = null;
    }

    return view('nextofkins.dashboard', compact('nextOfKin', 'resident'));
}


}

