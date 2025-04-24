<?php

namespace App\Http\Controllers;

use App\Models\MedicalHistory;
use Illuminate\Http\Request;
use App\Models\Resident;

class MedicalHistoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:residents,id',
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'diagnosed_at' => 'nullable|date',
            'source' => 'nullable|string|max:255',
            'visibility' => 'nullable|string|max:50',
            'description' => 'nullable|string',
        ]);

        MedicalHistory::create([
            ...$request->all(),
            'added_by' => auth('staff')->id(), // make sure you have a staff auth guard
        ]);

        return back()->with('success', 'Medical history added.');
    }

    public function index($residentId)
    {
        $histories = \App\Models\MedicalHistory::where('resident_id', $residentId)->latest()->get();
        return view('medical_history.index', compact('histories', 'residentId'));
    }
    
    public function overview()
{
    $residents = Resident::with(['medicalHistories'])->get(); // eager load histories
    return view('medical_history.overview', compact('residents'));
}
}
