<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Repositories\ResidentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Flash;
use Response;
use App\Models\Resident;

class ResidentController extends AppBaseController
{
    /** @var ResidentRepository */
    private $residentRepository;

    public function __construct(ResidentRepository $residentRepo)
    {
        $this->residentRepository = $residentRepo;
    }

    /**
     * Display a listing of the residents.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $residents = $this->residentRepository->all();

        return view('residents.index')->with('residents', $residents);
    }

    /**
     * Show the form for creating a new resident.
     *
     * @return Response
     */
    public function create()
    {
        return view('residents.create');
    }

    /**
     * Store a newly created resident in storage.
     *
     * @param CreateResidentRequest $request
     * @return Response
     */
    public function store(CreateResidentRequest $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'dateofbirth' => 'required|date',
            'gender' => 'nullable|string|max:20',
            'roomnumber' => 'nullable|integer',
            'admissiondate' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'doctor_notes' => 'nullable|string',
        ]);

        $resident = $this->residentRepository->create($validatedData);

        Flash::success('Resident saved successfully.');

        return redirect(route('residents.index'));
    }

    /**
     * Display the specified resident.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found.');
            return redirect(route('residents.index'));
        }

        return view('residents.show')->with('resident', $resident);
    }

    /**
     * Show the form for editing the specified resident.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found.');
            return redirect(route('residents.index'));
        }

        return view('residents.edit')->with('resident', $resident);
    }

    /**
     * Update the specified resident in storage.
     *
     * @param int $id
     * @param UpdateResidentRequest $request
     * @return Response
     */
    public function update($id, UpdateResidentRequest $request)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found.');
            return redirect(route('residents.index'));
        }

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'dateofbirth' => 'required|date',
            'gender' => 'nullable|string|max:20',
            'roomnumber' => 'nullable|integer',
            'admissiondate' => 'nullable|date',
            'medical_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'doctor_notes' => 'nullable|string',
        ]);

        $resident->update($validatedData);

        Flash::success('Resident updated successfully.');

        return redirect(route('residents.index'));
    }

    /**
     * Remove the specified resident from storage.
     *
     * @param int $id
     * @throws \Exception
     * @return Response
     */
    public function destroy($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found.');
            return redirect(route('residents.index'));
        }

        $this->residentRepository->delete($id);

        Flash::success('Resident deleted successfully.');

        return redirect(route('residents.index'));
    }

    /**
     * Show the medical record of a resident (Only for authorized staff).
     *
     * @param int $id
     * @return Response
     */
    public function showMedicalRecord($id)
    {
        $resident = Resident::find($id);

        if (!$resident) {
            return redirect()->route('dashboard')->with('error', 'Resident not found.');
        }

        // Ensure user is logged in before checking permissions
        if (!Auth::check() || !Auth::user()->can('view_medical_records')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view this record.');
        }

        // Log access to the medical record
        Log::info('Medical record accessed', [
            'staff_id' => Auth::id(),
            'staff_name' => Auth::user()->firstname . ' ' . Auth::user()->lastname,
            'resident_name' => $resident->firstname . ' ' . $resident->lastname,
            'time' => now(),
        ]);

        return view('residents.medical_record')->with('resident', $resident);
    }

    /**
     * Search for residents by name, room number, or medical record number.
     *
     * @param Request $request
     * @return Response
     */
   public function search(Request $request)
{
    $query = $request->input('query');

    // Search for residents based on name, room number, or ID
    $residents = Resident::where('firstname', 'LIKE', "%$query%")
        ->orWhere('lastname', 'LIKE', "%$query%")
        ->orWhere('roomnumber', 'LIKE', "%$query%")
        ->orWhere('id', 'LIKE', "%$query%") // Assuming ID is used as a medical record number
        ->get();

    // If only one result, redirect to the medical record page
    if ($residents->count() == 1) {
        return redirect()->route('residents.medical_records', ['id' => $residents->first()->id]);
    }

    // If multiple results, show a filtered list of residents
    return view('residents.index')->with('residents', $residents);
}

}
