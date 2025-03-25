<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\DiagnosisType;
use App\Models\StaffMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Response;

class DiagnosisController extends Controller
{
    /**
     * Display a listing of resident diagnoses (many-to-many).
     */
    public function index()
    {
        $residents = Resident::with(['diagnosistypes' => function ($query) {
            $query->withPivot([
                'vitalsigns', 'treatment', 'testresults', 'notes', 'lastupdatedby'
            ]);
        }])->get();

        return view('diagnoses.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resident diagnosis.
     */
    public function create()
    {
        $residents = Resident::all();
        $diagnosistypes = DiagnosisType::all();
        $staff = StaffMember::all();

        return view('diagnoses.create', compact('residents', 'diagnosistypes', 'staff'));
    }

    /**
     * Store a new diagnosis in the pivot table.
     */
    public function store(Request $request)
    {
        $request->validate([
            'residentid' => 'required|exists:residents,id',
            'diagnosistypeid' => 'required|exists:diagnosistype,id',
            'vitalsigns' => 'nullable|string|max:255',
            'treatment' => 'nullable|string|max:255',
            'testresults' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:255',
            'lastupdatedby' => 'nullable|exists:staffmember,id',
        ]);

        $resident = Resident::findOrFail($request->residentid);

        $resident->diagnosistypes()->attach($request->diagnosistypeid, [
            'vitalsigns' => $request->vitalsigns,
            'treatment' => $request->treatment,
            'testresults' => $request->testresults,
            'notes' => $request->notes,
            'lastupdatedby' => $request->lastupdatedby,
        ]);

        Flash::success('Diagnosis assigned successfully.');
        return redirect()->route('diagnoses.index');
    }

    /**
     * Show a specific diagnosis from the pivot.
     */
    public function show($id)
    {
        $diagnosis = DB::table('resident_diagnosis')->where('id', $id)->first();

        if (!$diagnosis) {
            Flash::error('Diagnosis not found.');
            return redirect()->route('diagnoses.index');
        }

        $resident = Resident::find($diagnosis->residentid);
        $diagnosistype = DiagnosisType::find($diagnosis->diagnosistypeid);
        $staff = StaffMember::find($diagnosis->lastupdatedby);

        return view('diagnoses.show', compact('diagnosis', 'resident', 'diagnosistype', 'staff'));
    }

    /**
     * Show the form for editing a resident diagnosis (pivot).
     */
    public function edit($id)
    {
        $diagnosis = DB::table('resident_diagnosis')->where('id', $id)->first();

        if (!$diagnosis) {
            Flash::error('Diagnosis not found.');
            return redirect()->route('diagnoses.index');
        }

        $residents = Resident::all();
        $diagnosistypes = DiagnosisType::all();
        $staff = StaffMember::all();

        return view('diagnoses.edit', compact('diagnosis', 'residents', 'diagnosistypes', 'staff'));
    }

    /**
     * Update a diagnosis in the pivot table.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'vitalsigns' => 'nullable|string|max:255',
            'treatment' => 'nullable|string|max:255',
            'testresults' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:255',
            'lastupdatedby' => 'nullable|exists:staffmember,id',
        ]);

        $diagnosis = DB::table('resident_diagnosis')->where('id', $id)->first();

        if (!$diagnosis) {
            Flash::error('Diagnosis not found.');
            return redirect()->route('diagnoses.index');
        }

        DB::table('resident_diagnosis')->where('id', $id)->update([
            'vitalsigns' => $request->vitalsigns,
            'treatment' => $request->treatment,
            'testresults' => $request->testresults,
            'notes' => $request->notes,
            'lastupdatedby' => $request->lastupdatedby,
            'updated_at' => now(),
        ]);

        Flash::success('Diagnosis updated successfully.');
        return redirect()->route('diagnoses.index');
    }

    /**
     * Delete a diagnosis from the pivot table.
     */
    public function destroy($id)
    {
        $diagnosis = DB::table('resident_diagnosis')->where('id', $id)->first();

        if (!$diagnosis) {
            Flash::error('Diagnosis not found.');
            return redirect()->route('diagnoses.index');
        }

        DB::table('resident_diagnosis')->where('id', $id)->delete();

        Flash::success('Diagnosis deleted successfully.');
        return redirect()->route('diagnoses.index');
    }

    /**
     * Search diagnosis by resident name.
     */
    public function search(Request $request)
    {
        $query = trim($request->input('query'));

        if (empty($query)) {
            return redirect()->route('diagnoses.searchPage')->with('error', 'Please enter a resident name.');
        }

        $resident = Resident::where('firstname', 'LIKE', "%$query%")
            ->orWhere('lastname', 'LIKE', "%$query%")
            ->first();

        if (!$resident) {
            return redirect()->route('diagnoses.searchPage')->with('error', 'No diagnoses found for this resident.');
        }

        $resident->load('diagnosistypes');
        return view('diagnoses.search', compact('resident'));
    }

    /**
     * Show the search form view.
     */
    public function searchPage()
    {
        return view('diagnoses.search');
    }
}
