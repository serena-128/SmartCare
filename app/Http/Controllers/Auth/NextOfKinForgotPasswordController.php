<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class NextOfKinForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Display the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.nextofkin-forgot-password');
    }

    /**
     * Get the password broker for Next-of-Kin.
     */
    public function broker()
    {
        return Password::broker('nextofkins');
    }
}
