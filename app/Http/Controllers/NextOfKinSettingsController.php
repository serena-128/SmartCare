<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NextOfKin;

class NextOfKinSettingsController extends Controller
{
    /**
     * Update Next of Kin Profile Information
     */
    public function updateProfile(Request $request)
    {
        $nextOfKin = Auth::guard('nextofkin')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:nextofkins,email,' . $nextOfKin->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $nextOfKin->update([
            'firstname' => $request->name,
            'email' => $request->email,
            'contactnumber' => $request->phone,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update Notification Preferences
     */
    public function updateNotifications(Request $request)
    {
        $nextOfKin = Auth::guard('nextofkin')->user();

        $nextOfKin->update([
            'email_notifications' => $request->has('email_notifications'),
            'sms_notifications' => $request->has('sms_notifications'),
            'carehome_updates' => $request->has('carehome_updates'),
        ]);

        return back()->with('success', 'Notification preferences updated.');
    }
}
