<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\Resident;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function showOverdue(Request $request)
    {
        $query = Medication::where('scheduled_time', '<', now())
            ->where('taken', false)
            ->with('resident');

        // Filter by resident if selected
        if ($request->filled('resident_id')) {
            $query->where('resident_id', $request->resident_id);
        }

        $medications = $query->get();
        $allResidents = Resident::orderBy('lastname')->get();

        return view('medications.overdue', compact('medications', 'allResidents'));
    }

    public function markTaken($id)
    {
        $med = Medication::findOrFail($id);
        $med->taken = true;
        $med->save();

        return redirect()->back()->with('success', 'Medication marked as taken.');
    }

    public function missedHistory()
    {
        $missed = Medication::with('resident')
            ->where('taken', false)
            ->where('scheduled_time', '<', now()->subDays(2))
            ->get()
            ->groupBy('resident_id');

        return view('medications.missed-history', compact('missed'));
    }
}
