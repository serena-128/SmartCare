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
    public function showCompleteProfileForm()
    {
        // Retrieve the next of kin record using session data.
        $nextofkinId = session('nextofkin_id');
        if (!$nextofkinId) {
            return redirect()->route('nextofkin.register')->with('error', 'Please register first.');
        }
        
        $nextofkin = NextOfKin::findOrFail($nextofkinId);
        return view('nextofkins.complete-profile', compact('nextofkin'));
    }
    
    public function completeProfile(Request $request)
    {
        $request->validate([
            'contactnumber'           => 'required|string|max:20',
            'address'                 => 'required|string|max:255',
            'relationshiptoresident'  => 'required|string|max:50',
        ]);

        $nextofkinId = session('nextofkin_id');
        if (!$nextofkinId) {
            return redirect()->route('nextofkin.register')->with('error', 'Please register first.');
        }

        $nextofkin = NextOfKin::findOrFail($nextofkinId);
        $nextofkin->update([
            'contactnumber'          => $request->contactnumber,
            'address'                => $request->address,
            'relationshiptoresident' => $request->relationshiptoresident,
        ]);

        // Clear the session if no longer needed.
        session()->forget('nextofkin_id');

        // Redirect to the login page after successful profile completion.
        return redirect()->route('nextofkin.login')->with('success', 'Profile updated successfully. Please log in.');
    }
} 
