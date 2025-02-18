<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NextOfKin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NextOfKinRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.nextofkin-register');
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
            'firstname'              => $request->firstname,
            'lastname'               => $request->lastname,
            'email'                  => $request->email,
            'password'               => Hash::make($request->password),
            // add additional fields as needed
        ]);

        return redirect()->route('nextofkin.login')->with('status', 'Registration successful. Please log in.');
    }
}
