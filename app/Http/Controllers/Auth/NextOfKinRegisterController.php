<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NextOfKin;
use App\Models\Resident;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class NextOfKinRegisterController extends Controller
{
    /**
     * Show the Next of Kin registration form.
     */
    public function showRegistrationForm()
    {
        // Only show residents who don't already have a next of kin linked.
        $residentIDsWithNextOfKin = NextOfKin::pluck('residentid')->toArray();
        $residents = Resident::select('id', 'firstname', 'lastname')
            ->whereNotIn('id', $residentIDsWithNextOfKin)
            ->get();

        return view('auth.nextofkin-register', compact('residents'));
    }

    /**
     * Handle the registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'firstname'        => 'required|string|max:50',
            'lastname'         => 'required|string|max:50',
            'resident_id'      => 'required|exists:resident,id',
            'email'            => 'required|email|unique:nextofkin,email',
            'password'         => 'required|string|min:6|confirmed',
            'profile_picture'  => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $nextOfKin = NextOfKin::create([
            'firstname'   => $request->firstname,
            'lastname'    => $request->lastname,
            'residentid'  => $request->resident_id,
            'email'       => $request->email,
            'password'    => Hash::make($request->password),
            // Optionally store profile picture path if needed:
            // 'profile_picture' => $profilePicturePath,
        ]);

        // Instead of auto-logging in the user, store their ID in the session.
        session(['nextofkin_id' => $nextOfKin->id]);

        // If the user was logged in automatically by any trait or code, log them out.
        Auth::guard('nextofkin')->logout();

        // Redirect to the profile completion page.
        return redirect()->route('nextofkin.complete-profile');
    }


}
