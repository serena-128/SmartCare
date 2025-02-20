<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NextOfKinLoginController extends Controller
{
    /**
     * Show the Next of Kin login form.
     */
    public function showLoginForm()
    {
        return view('auth.nextofkin-login');
    }

    /**
     * Handle a login request for Next of Kin.
     */
    public function login(Request $request)
    {
        // Validate the login form data.
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in using the 'nextofkin' guard.
        if (Auth::guard('nextofkin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Regenerate the session to prevent fixation attacks.
            $request->session()->regenerate();

            // Redirect to the intended page (or dashboard).
            return redirect()->intended(route('nextofkins.dashboard'));
        }

        // If the login attempt was unsuccessful, redirect back with an error.
        return back()->withInput($request->only('email', 'remember'))
                     ->withErrors(['email' => 'These credentials do not match our records.']);
    }

    /**
     * Log the Next of Kin user out.
     */
    public function logout(Request $request)
    {
        Auth::guard('nextofkin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('nextofkin.login'));
    }
}

