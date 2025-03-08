<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NextOfKin;
use App\Models\Resident;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NextOfKinRegisterController extends Controller
{
    public function showRegistrationForm()
{
    $residents = Resident::select('id', 'firstname', 'lastname')->get();
    return view('auth.nextofkin-register', compact('residents'));
}

    public function register(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:50',
        'lastname' => 'required|string|max:50',
        'resident_id' => 'required|exists:resident,id',
        'email' => 'required|email|unique:nextofkin,email',
        'password' => 'required|string|min:6|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048', // Validate image upload
    ]);
        $profilePicturePath = null;

    // Handle profile picture upload
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            // Create Next of Kin entry
    NextOfKin::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'residentid' => $request->resident_id,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'profile_picture' => $profilePicturePath, // Save image path in the database
    ]);


        return redirect()->route('nextofkin.login')->with('status', 'Registration successful. Please log in.');
    }
}
