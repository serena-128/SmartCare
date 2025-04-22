<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Fetch 5 most recent notifications and unread count
    public function fetch()
    {
        $user = Auth::guard('nextofkin')->user();

        $notifications = Notification::where('nextofkin_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $count = Notification::where('nextofkin_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json([
            'notifications' => $notifications,
            'count' => $count
        ]);
    }

    // Mark all unread notifications as read
    public function markAsRead()
    {
        $user = Auth::guard('nextofkin')->user();

        Notification::where('nextofkin_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
