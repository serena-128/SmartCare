<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoadUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Eager-load the role relationship for the authenticated user
        $user = Auth::user();
        if ($user) {
            $user->load('role');  // Load the role relationship
        }

        return $next($request);
    }
}
