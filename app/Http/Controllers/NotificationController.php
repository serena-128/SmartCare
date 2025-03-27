<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function getCount()
    {
        $user = Auth::guard('nextofkin')->user();
        $notifications = Notification::where('nextofkin_id', $user->id)
                            ->where('is_new', true)
                            ->get();

        return response()->json([
            'count' => $notifications->count(),
            'notifications' => $notifications,
        ]);
    }
}
