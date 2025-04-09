<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client as GoogleClient;
use Google\Service\Fitness as GoogleFitness;

class GoogleFitController extends Controller
{
    public function connect()
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));
        $client->addScope(GoogleFitness::FITNESS_ACTIVITY_READ);
        $client->addScope(GoogleFitness::FITNESS_HEART_RATE_READ);
        $client->addScope(GoogleFitness::FITNESS_SLEEP_READ);

        return redirect()->away($client->createAuthUrl());
    }

    public function callback(Request $request)
    {
        $client = new GoogleClient();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        $client->fetchAccessTokenWithAuthCode($request->code);
        session(['google_token' => $client->getAccessToken()]);

        return redirect()->route('googlefit.data');
    }

    public function getData()
    {
        $token = session('google_token');
        if (!$token) {
            return redirect()->route('googlefit.connect');
        }

        $client = new GoogleClient();
        $client->setAccessToken($token);
        $fitness = new GoogleFitness($client);

        return response()->json(['message' => 'Google Fit connected successfully!']);
    }
}
