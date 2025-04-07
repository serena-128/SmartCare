<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmergencyAlertAuthorization
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to trigger an emergency alert.');
        }

        if (!Auth::user()->isAuthorizedStaff()) {
            return redirect()->route('dashboard')->with('error', 'Only authorized staff can send emergency alerts.');
        }

        return $next($request);
    }
}
