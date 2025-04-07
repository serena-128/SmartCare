<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class NextOfKinForgotPasswordController extends Controller
{
    /**
     * Show the password reset request form for Next-of-Kin.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.nextofkin-email'); // ✅ Ensure this view exists
    }

    /**
     * Handle sending the password reset email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('nextofkins')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Get the password broker for Next-of-Kin.
     */
    public function broker()
    {
        return Password::broker('nextofkins'); // ✅ Ensure 'nextofkins' exists in `config/auth.php`
    }
}
