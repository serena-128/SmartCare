<?php

return [

    'defaults' => [
        'guard' => 'nextofkin',  // Set 'nextofkin' as the default if needed
        'passwords' => 'nextofkins',
    ],
        
    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],

        'nextofkin' => [
            'driver'   => 'session',
            'provider' => 'nextofkins',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'nextofkins' => [
            'driver' => 'eloquent',
            'model' => App\Models\NextOfKin::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_resets',
            'expire'   => 60,
            'throttle' => 60,
        ],

        'nextofkins' => [
            'provider' => 'nextofkins',  
            'table'    => 'password_resets',
            'expire'   => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
