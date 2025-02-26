<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,                      // Handles proxy headers and trusted proxies.
        \Fruitcake\Cors\HandleCors::class,                             // Handles CORS headers.
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // Prevents requests during maintenance.
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // Validates the size of POST requests.
        \App\Http\Middleware\TrimStrings::class,                       // Trims whitespace from input.
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // Converts empty strings to null.
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,                   // Encrypts cookies for the web session.
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Adds cookies to the response.
            \Illuminate\Session\Middleware\StartSession::class,           // Starts the session for the user.
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,   // Shares session errors with views.
            \App\Http\Middleware\VerifyCsrfToken::class,                 // Verifies the CSRF token for requests.
            \Illuminate\Routing\Middleware\SubstituteBindings::class,    // Substitutes route bindings (parameters).
        ],

        'api' => [
            'throttle:api',                                              // Throttles API requests (rate limiting).
            \Illuminate\Routing\Middleware\SubstituteBindings::class,    // Substitutes route bindings for API routes.
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        //'auth' => \App\Http\Middleware\Authenticate::class,             // Ensures the user is authenticated.
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // Basic authentication middleware.
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, // Sets HTTP cache headers.
        'can' => \Illuminate\Auth\Middleware\Authorize::class,         // Verifies if a user has the required permission.
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // Redirects authenticated users if they try to access guest pages.
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // Ensures the user confirms their password.
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class, // Validates signed URLs.
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // Throttles requests.
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // Ensures the user's email is verified.

        // ✅ Emergency Alert Authorization Middleware
        'emergency_auth' => \App\Http\Middleware\EmergencyAlertAuthorization::class,

        // ✅ Load User Role Middleware
        'load.user.role' => \App\Http\Middleware\LoadUserRole::class,
    ];
}
