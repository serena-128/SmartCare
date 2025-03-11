<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NextOfKin;

class NextOfKinProfileController extends Controller
{
    /**
     * Show the form to complete the Next of Kin profile.
     */
    public function showForm()
    {
        $nextOfKin = Auth::guard('nextofkin')->user();

        return view('nextofkins.complete-profile', compact('nextOfKin'));
    }

    /**
     * Store the completed profile details.
     */
    public function store(Request $request)
    {
        $request->validate([
            'relationshiptoresident' => 'required|string|max:100',
            'contactnumber' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        $nextOfKin = Auth::guard('nextofkin')->user();

        $nextOfKin->update([
            'relationshiptoresident' => $request->relationshiptoresident,
            'contactnumber' => $request->contactnumber,
            'address' => $request->address,
        ]);

        return redirect()->route('nextofkins.dashboard')->with('status', 'Profile updated successfully.');


    }
}

