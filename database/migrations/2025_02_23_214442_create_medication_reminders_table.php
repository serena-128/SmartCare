<?php

namespace App\Http\Controllers;

use App\Models\MedicationReminder;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicationReminderController extends Controller
{
    public function index()
    {
        $reminders = MedicationReminder::with(['resident', 'staffMember'])->get();
        return view('medication_reminders.index', compact('reminders'));
    }

    public function create()
    {
        $residents = Resident::all();
        return view('medication_reminders.create', compact('residents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:resident,id',
            'medication_name' => 'required|string|max:100',
            'dosage' => 'required|string|max:50',
            'frequency' => 'required|string|max:50',
            'time_for_administration' => 'required|date_format:H:i'
        ]);

        MedicationReminder::create([
            'resident_id' => $request->resident_id,
            'staffmember_id' => Auth::id(),
            'medication_name' => $request->medication_name,
            'dosage' => $request->dosage,
            'frequency' => $request->frequency,
            'time_for_administration' => $request->time_for_administration
        ]);

        return redirect()->route('medication_reminders.index')->with('success', 'Medication reminder successfully scheduled.');
    }
}
