<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\DietaryRestriction;
use App\Models\StaffMember;
use Illuminate\Http\Request;

class ResidentDietaryController extends Controller
{
    // Show the form to create dietary restriction for a resident
    public function create()
    {
        // Fetch all residents
        $residents = Resident::all();

        // Fetch staff members for "last updated by" dropdown
        $staffmembers = Staffmember::all();

        return view('dietaryrestrictions.create', compact('residents', 'staffMembers'));
    }

    // Store dietary restriction data
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'food_restrictions' => 'nullable|string',
            'food_preferences' => 'nullable|string',
            'allergies' => 'nullable|string',
            'notes' => 'nullable|string',
            'last_updated_by' => 'required|exists:staff_members,id',
        ]);

        // Create the dietary restriction record
        DietaryRestriction::create([
            'resident_id' => $validated['resident_id'],
            'food_restrictions' => $validated['food_restrictions'],
            'food_preferences' => $validated['food_preferences'],
            'allergies' => $validated['allergies'], // Store the allergy as text
            'notes' => $validated['notes'],
            'last_updated_by' => $validated['last_updated_by'],
        ]);

        // Redirect back with success message
        return redirect()->route('dietaryrestrictions.index')->with('success', 'Dietary restrictions successfully recorded.');
    }
}

