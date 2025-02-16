<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NextOfKinLoginController extends Controller
{
    // Show the login form for nextofkin users
    public function showLoginForm()
    {
        return view('auth.nextofkin-login'); // create this view
    }

    // Handle the login submission
    public function login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in using the custom guard
        if (Auth::guard('nextofkin')->attempt($credentials, $request->filled('remember'))) {
            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect to intended location (adjust route as needed)
            return redirect()->intended('/nextofkin/dashboard');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Log the user out
    public function logout(Request $request)
    {
        Auth::guard('nextofkin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/nextofkin/login');
    }
}

