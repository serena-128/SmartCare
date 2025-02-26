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
        // Get the currently logged-in next of kin
        $nextOfKin = Auth::guard('nextofkin')->user();

        // Fetch the resident assigned to this Next-of-Kin
        $resident = Resident::where('id', $nextOfKin->residentid)->first();

        // Pass the resident data to the dashboard view
        return view('nextofkins.dashboard', compact('resident'));
    }
}

