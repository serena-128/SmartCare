<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CareLog;
use App\Models\Resident;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CareLogController extends Controller
{
    /**
     * Show the form for logging care activity.
     */
    public function create($resident_id)
    {
        $resident = Resident::findOrFail($resident_id);
        return view('care_logs.create', compact('resident'));
    }

    /**
     * Store a new care log entry with user-provided date and caregiver details.
     */
    public function store(Request $request, $resident_id)
    {
        // Validation rules
        $request->validate([
            'activity_type' => 'required|in:Medication,Bathing,Feeding,Exercise',
            'notes' => 'nullable|string',
            'logged_at' => 'required|date',
            'caregiver_name' => 'required|string',
            'caregiver_type' => 'required|string',
        ]);

        // Determine caregiver ID, using authenticated user ID if available
        $caregiverId = Auth::id() ?? null; // Can be null if not authenticated

        // Check for duplicates within the last 30 minutes
        $recentLog = CareLog::where('resident_id', $resident_id)
            ->where('activity_type', $request->activity_type)
            ->where('caregiver_name', $request->caregiver_name)
            ->where('logged_at', '>=', Carbon::parse($request->logged_at)->subMinutes(30))
            ->first();

        if ($recentLog) {
            return redirect()->back()->withErrors(['error' => 'Duplicate log detected. Please wait at least 30 minutes before logging the same activity.']);
        }

        // Create care log entry with caregiver name and type
        CareLog::create([
            'resident_id'     => $resident_id,
            'activity_type'   => $request->activity_type,
            'notes'           => $request->notes,
            'caregiver_id'    => $caregiverId,
            'caregiver_name'  => $request->caregiver_name,
            'caregiver_type'  => $request->caregiver_type,
            'logged_at'       => Carbon::parse($request->logged_at),
        ]);

        return redirect()->route('residents.show', $resident_id)
            ->with('success', 'Care log successfully recorded.');
    }
}
