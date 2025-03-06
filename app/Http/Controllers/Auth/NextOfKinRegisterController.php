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
        $validator = Validator::make($request->all(), [
            'firstname'              => 'required|string|max:50',
            'lastname'               => 'required|string|max:50',
            'email'                  => 'required|email|unique:nextofkin,email',
            'password'               => 'required|string|min:6|confirmed',
            // add additional fields as needed
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            NextOfKin::create([
        'residentid' => $request->resident_id,  // Store selected resident
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);


        return redirect()->route('nextofkin.login')->with('status', 'Registration successful. Please log in.');
    }
}
