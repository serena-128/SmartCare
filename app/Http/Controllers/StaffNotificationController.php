<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffNotificationController extends Controller
{

    public function index(Request $request)
    {
        $notifications = $request->user()->notifications; // or ->unreadNotifications
        return view('staff.notifications', compact('notifications'));
    }
}

