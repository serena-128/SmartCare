<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NextOfKinAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.nextofkin-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('nextofkin')->attempt($credentials)) {
            return redirect()->intended('/nextofkin/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout()
    {
        Auth::guard('nextofkin')->logout();
        return redirect('/nextofkin/login');
    }
}