<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatediagnosisRequest;
use App\Http\Requests\UpdatediagnosisRequest;
use App\Repositories\diagnosisRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Diagnosis;
use App\Models\Resident;
use App\Models\Staffmember;
use Flash;
use Illuminate\Support\Facades\Auth;
use Response;

class diagnosisController extends AppBaseController
{
    /** @var diagnosisRepository $diagnosisRepository */
    private $diagnosisRepository;

    public function __construct(diagnosisRepository $diagnosisRepo)
    {
        $this->diagnosisRepository = $diagnosisRepo;
    }

    /**
     * Display a listing of the diagnosis.
     *
     * @return Response
     */
  public function index(Request $request)
{
    $query = Diagnosis::with(['resident', 'lastUpdatedBy']);

    // Search by resident name
    if ($request->filled('resident_name')) {
        $query->whereHas('resident', function ($q) use ($request) {
            $q->where('firstname', 'LIKE', '%' . $request->resident_name . '%')
              ->orWhere('lastname', 'LIKE', '%' . $request->resident_name . '%');
        });
    }

    // Filter by diagnosis type
    if ($request->filled('diagnosis_type')) {
        $query->where('diagnosis', 'LIKE', '%' . $request->diagnosis_type . '%');
    }

    // Filter by staff member
    if ($request->filled('staff_id')) {
        $query->where('lastupdatedby', $request->staff_id);
    }

    // 👉 Get all and group by resident
    $allDiagnoses = $query->orderBy('residentid')->get();
    $diagnoses = $allDiagnoses->groupBy('residentid');

    $staffMembers = \App\Models\Staffmember::all();

    return view('diagnoses.index', compact('diagnoses', 'staffMembers'));
}


    /**
     * Show the form for creating a new diagnosis.
     *
     * @return Response
     */
    public function create()
    {
        return view('diagnoses.create');
    }

    /**
     * Store a newly created diagnosis in storage.
     *
     * @param CreatediagnosisRequest $request
     * @return Response
     */
   public function store(CreatediagnosisRequest $request)
{
    $input = $request->all();

    // 🔐 Use session-based login since you're not using Laravel Auth
    $staffId = session('staff_id'); // Laravel-friendly way to get session variable
    $staff = Staffmember::find($staffId);

    if ($staff) {
        $input['lastupdatedby'] = $staff->id;
    } else {
        Flash::error('No staff member found in session.');
        return redirect()->back();
    }

    $this->diagnosisRepository->create($input);

    Flash::success('Diagnosis saved successfully.');
    return redirect(route('diagnoses.index'));
}


    /**
     * Display the specified diagnosis.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $diagnosis = $this->diagnosisRepository->find($id);

        if (empty($diagnosis)) {
            Flash::error('Diagnosis not found');
            return redirect(route('diagnoses.index'));
        }

        return view('diagnoses.show')->with('diagnosis', $diagnosis);
    }

    /**
     * Show the form for editing the specified diagnosis.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $diagnosis = $this->diagnosisRepository->find($id);

        if (empty($diagnosis)) {
            Flash::error('Diagnosis not found');
            return redirect(route('diagnoses.index'));
        }

        return view('diagnoses.edit')->with('diagnosis', $diagnosis);
    }

    /**
     * Update the specified diagnosis in storage.
     *
     * @param int $id
     * @param UpdatediagnosisRequest $request
     * @return Response
     */
    public function update($id, UpdatediagnosisRequest $request)
{
    $diagnosis = Diagnosis::find($id);

    if (!$diagnosis) {
        Flash::error('Diagnosis not found.');
        return redirect(route('diagnoses.index'));
    }

    $diagnosis->update($request->all());

    Flash::success('Diagnosis updated successfully.');
    return redirect(route('diagnoses.index'));
}


    /**
     * Remove the specified diagnosis from storage.
     *
     * @param int $id
     * @throws \Exception
     * @return Response
     */
    public function destroy($id)
    {
        $diagnosis = $this->diagnosisRepository->find($id);

        if (empty($diagnosis)) {
            Flash::error('Diagnosis not found');
            return redirect(route('diagnoses.index'));
        }

        $this->diagnosisRepository->delete($id);
        Flash::success('Diagnosis deleted successfully.');
        return redirect(route('diagnoses.index'));
    }

    /**
     * Search for a resident's diagnosis.
     *
     * @param Request $request
     * @return Response
     */
    public function search(Request $request)
    {
        $query = trim($request->input('query'));

        if (empty($query)) {
            return redirect()->route('diagnoses.searchPage')->with('error', 'Please enter a resident name.');
        }

        // Find the resident by first or last name
        $resident = Resident::where('firstname', 'LIKE', "%$query%")
                    ->orWhere('lastname', 'LIKE', "%$query%")
                    ->first();

        if (!$resident) {
            return redirect()->route('diagnoses.searchPage')->with('error', 'No diagnoses found for this resident.');
        }

        // Fetch only the diagnoses for the searched resident
        $diagnoses = Diagnosis::where('residentid', $resident->id)
                    ->with(['resident', 'lastUpdatedBy'])
                    ->get();

        return view('diagnoses.search', compact('diagnoses'));
    }

    /**
     * Show the diagnosis search page.
     *
     * @return Response
     */
    public function searchPage()
    {
        return view('diagnoses.search'); // Ensure this view exists
    }
    
}
