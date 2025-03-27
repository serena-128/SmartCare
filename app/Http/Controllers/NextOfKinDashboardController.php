<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NextOfKin; // Import NextOfKin model
use App\Models\Resident;// Import Resident model
use App\Models\News;      // Import News model
use App\Models\Photo;     // Import Photo model
use App\Models\Bulletin;  // Import Bulletin model

class NextOfKinDashboardController extends Controller
{
    /**
     * Display the dashboard for the logged-in Next-of-Kin.
     */
    public function index()
{
    // Get the authenticated next of kin
    $nextOfKin = Auth::guard('nextofkin')->user();

    if (!$nextOfKin) {
        return redirect()->route('nextofkin.login')->with('error', 'Please log in first.');
    }

    // Debugging: Print next of kin info
    \Log::info('Logged-in NextOfKin:', ['id' => $nextOfKin->id, 'residentid' => $nextOfKin->residentid]);

    // Check if residentid is null or missing
    if (!$nextOfKin->residentid) {
        \Log::warning('NextOfKin has no resident assigned:', ['id' => $nextOfKin->id]);
        return view('nextofkins.dashboard', ['resident' => null]);
    }

    // Fetch the resident assigned to this Next-of-Kin
       $resident = Resident::find($nextOfKin->residentid);

    // Debugging: Check if Resident is found
    if (!$resident) {
        \Log::warning('Resident not found for NextOfKin:', ['nextofkin_id' => $nextOfKin->id, 'residentid' => $nextOfKin->residentid]);
    } else {
        \Log::info('Resident found:', ['id' => $resident->id, 'name' => $resident->firstname . ' ' . $resident->lastname]);
    }
        // Fetch the dynamic content for the News section
        $newsUpdates = News::orderBy('date', 'desc')->get();
        $photoGallery = Photo::orderBy('created_at', 'desc')->get();
        $bulletinBoard = Bulletin::orderBy('date', 'asc')->get();

    return view('nextofkins.dashboard', compact('resident', 'nextOfKin', 'newsUpdates', 'photoGallery', 'bulletinBoard'));
}

public function profile()
{
    // Get the authenticated Next of Kin
    $nextOfKin = Auth::guard('nextofkin')->user();
    
    if (!$nextOfKin) {
        return redirect()->route('nextofkin.login')->with('error', 'Please log in first.');
    }

    // Return the profile view with the user's data
    return view('nextofkins.profile', compact('nextOfKin'));
}
public function updateProfile(Request $request)
{
    $nextOfKin = Auth::guard('nextofkin')->user();

    if (!$nextOfKin) {
        return redirect()->route('nextofkin.login')->with('error', 'Please log in first.');
    }

    // Validate the form input
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'firstname' => 'required|string|max:50',
        'lastname' => 'required|string|max:50',
        'email' => 'required|email|unique:nextofkin,email,' . $nextOfKin->id,
    ]);

    // Handle Profile Picture Upload
    if ($request->hasFile('profile_picture')) {
        $image = $request->file('profile_picture');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = $image->storeAs('profile_pictures', $imageName, 'public');

        // Delete old profile picture if exists
        if ($nextOfKin->profile_picture) {
            \Storage::disk('public')->delete($nextOfKin->profile_picture);
        }

        // Update profile picture path
        $nextOfKin->profile_picture = $imagePath;
    }

    // Update Other Fields in the Database
    $nextOfKin->firstname = $request->firstname;
    $nextOfKin->lastname = $request->lastname;
    $nextOfKin->email = $request->email;
    $nextOfKin->save();

    return redirect()->route('nextofkin.profile')->with('success', 'Profile updated successfully.');
}
    public function dashboard()
{
    $newsUpdates = News::orderBy('publication_date', 'desc')->get();
    $photoGallery = Photo::orderBy('created_at', 'desc')->get();
    $bulletinBoard = Bulletin::orderBy('date', 'asc')->get();

    return view('dashboard', compact('newsUpdates', 'photoGallery', 'bulletinBoard'));
}



}

