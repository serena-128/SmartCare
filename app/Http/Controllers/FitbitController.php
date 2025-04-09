<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;


class FitbitController extends Controller
{
    
public function fetchFitbitData()
{
    // ✅ Dummy Fitbit data instead of using real API
    $dummyData = [
        'steps' => 7200,
        'calories' => 2100,
        'sedentary' => 480,
    ];

    return response()->json($dummyData);
}


}
