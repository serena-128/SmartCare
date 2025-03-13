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

    // Debugging: Print next of kin info
    \Log::info('Logged-in NextOfKin:', ['id' => $nextOfKin->id, 'residentid' => $nextOfKin->residentid]);

    // Check if residentid is null or missing
    if (!$nextOfKin->residentid) {
        \Log::warning('NextOfKin has no resident assigned:', ['id' => $nextOfKin->id]);
        return view('nextofkins.dashboard', ['resident' => null]);
    }

    // Fetch the resident assigned to this Next-of-Kin
       $resident = Resident::find($nextOfKin->residentid);

    // Debugging: Check if Resident is found
    if (!$resident) {
        \Log::warning('Resident not found for NextOfKin:', ['nextofkin_id' => $nextOfKin->id, 'residentid' => $nextOfKin->residentid]);
    } else {
        \Log::info('Resident found:', ['id' => $resident->id, 'name' => $resident->firstname . ' ' . $resident->lastname]);
    }

    return view('nextofkins.dashboard', compact('resident', 'nextOfKin'));
}



}

