<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function showOverdue()
    {
        $medications = Medication::where('scheduled_time', '<', now())
            ->where('taken', false)
            ->with('resident')
            ->get();

        return view('medications.overdue', compact('medications'));
    }

    public function markTaken($id)
    {
        $med = Medication::findOrFail($id);
        $med->taken = true;
        $med->save();

        return redirect()->back()->with('success', 'Medication marked as taken.');
    }
}
