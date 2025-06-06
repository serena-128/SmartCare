<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\StaffMember;

class StaffAuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.staff_login');
    }

    // Process login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required', // Simple match for now (no hashing)
        ]);

        $staff = StaffMember::where('email', $request->email)->first();

        if ($staff) {
            // Store staff info in session
            Session::put('staff_id', $staff->id);
            Session::put('staff_name', $staff->firstname . ' ' . $staff->lastname);
            return redirect()->route('emergencyalerts.index');
        }

        return back()->withErrors(['login_error' => 'Invalid Credentials']);
    }

    // Logout
    public function logout()
    {
        Session::forget('staff_id');
        Session::forget('staff_name');
        return redirect('/login');
    }
}

