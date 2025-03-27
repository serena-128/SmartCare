<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StaffAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('staff_id')) {
            return redirect('/login')->withErrors(['login_error' => 'You must log in first.']);
        }

        return $next($request);
    }
}

