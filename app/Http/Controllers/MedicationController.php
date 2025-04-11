<?php

namespace App\Http\Controllers;

use App\Models\Medication;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Exports\MissedMedicationsExport;
use Maatwebsite\Excel\Facades\Excel;

class MedicationController extends Controller
{
    public function showOverdue(Request $request)
    {
        $query = Medication::where('scheduled_time', '<', now())
            ->where('taken', false)
            ->with('resident');

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

    public function missedHistory(Request $request)
    {
        $query = Medication::with('resident')
            ->where('taken', false)
            ->where('scheduled_time', '<', now()->subDays(2));

        if ($request->filled('resident_id')) {
            $query->where('resident_id', $request->resident_id);
        }

        $missed = $query->get()->groupBy('resident_id');
        $allResidents = Resident::orderBy('lastname')->get();

        return view('medications.missed-history', compact('missed', 'allResidents'));
    }

    public function exportMissedHistory(Request $request)
    {
        return Excel::download(
            new MissedMedicationsExport($request->resident_id),
            'missed_medications_report.xlsx'
        );
    }

    public function calendarView()
    {
        return view('medications.calendar'); // View should be in resources/views/medications/calendar.blade.php
    }

    public function calendarEvents()
    {
        $medications = Medication::with('resident')->get();

        $events = [];

        foreach ($medications as $med) {
            $events[] = [
                'title' => $med->resident->full_name . ' - ' . $med->medication_name,
                'start' => $med->scheduled_time,
                'color' => $med->taken ? '#28a745' : '#dc3545',
            ];
        }

        return response()->json($events);
    }
}
