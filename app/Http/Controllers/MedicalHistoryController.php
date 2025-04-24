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
    
 public function overview(Request $request)
{
    $type = $request->query('type');
    $search = $request->query('search');
    $from = $request->query('from');
    $to = $request->query('to');

    // Fetch all residents that have medical histories within the date range
    $residents = Resident::whereHas('medicalHistories', function ($query) use ($type, $from, $to) {
        // Apply filters to medical histories if provided
        if ($type) {
            $query->where('type', $type);
        }
        if ($from) {
            $query->whereDate('diagnosed_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('diagnosed_at', '<=', $to);
        }
        // Only consider medical histories with relevant date range
    })
    ->with(['medicalHistories' => function ($query) use ($type, $from, $to) {
        // Apply filters to medical histories if provided
        if ($type) {
            $query->where('type', $type);
        }
        if ($from) {
            $query->whereDate('diagnosed_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('diagnosed_at', '<=', $to);
        }
        // Order medical histories by diagnosed date descending to get the most recent one
        $query->orderByDesc('diagnosed_at');
    }])
    ->when($search, function ($query, $search) {
        // Apply search filter by resident name
        $query->where(function ($q) use ($search) {
            $q->where('firstname', 'like', "%$search%")
              ->orWhere('lastname', 'like', "%$search%");
        });
    })
    ->get();

    return view('medical_history.overview', compact('residents', 'type', 'search', 'from', 'to'));
}


    public function timeline($id)
{
    $resident = Resident::with(['medicalHistories' => function($q) {
        $q->orderBy('diagnosed_at', 'desc');
    }])->findOrFail($id);

    return view('medical_history.timeline', compact('resident'));
}
}
