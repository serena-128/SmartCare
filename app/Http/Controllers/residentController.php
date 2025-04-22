<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\CareLog;
use App\Models\User;
use App\Repositories\residentRepository;
use Flash;

class ResidentController extends Controller
{
    private $residentRepository;

    public function __construct(residentRepository $residentRepo)
    {
        $this->residentRepository = $residentRepo;
    }

    // List all residents
    public function index(Request $request)
    {
        $residents = $this->residentRepository->all();
        return view('residents.index', compact('residents'));
    }

    // Show form to create new resident
    public function create()
    {
        return view('residents.create');
    }

    // Save new resident
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'dateofbirth' => 'required|date',
            'gender' => 'nullable|string|max:20',
            'roomnumber' => 'nullable|integer',
            'admissiondate' => 'nullable|date',
        ]);

        $resident = $this->residentRepository->create($request->all());
        Flash::success('Resident saved successfully.');
        return redirect(route('residents.index'));
    }

    // Show single resident with diagnoses and care logs
    public function show(Request $request, $id)
    {
        $resident = Resident::with('diagnoses')->findOrFail($id);

        $careLogsQuery = CareLog::where('resident_id', $id);

        if ($request->filled('date')) {
            $careLogsQuery->whereDate('logged_at', $request->date);
        }

        if ($request->filled('caregiver_id')) {
            $careLogsQuery->where('caregiver_id', $request->caregiver_id);
        }

        $careLogs = $careLogsQuery->orderBy('logged_at', 'desc')->get();
        $caregivers = User::all();

        return view('residents.show', compact('resident', 'careLogs', 'caregivers'));
    }

    // Show form to edit resident
    public function edit($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        return view('residents.edit', compact('resident'));
    }

    // Update resident details
    public function update(Request $request, $id)
    {
        $request->validate([
            'roomnumber' => 'required|integer|min:1',
            'admissiondate' => 'required|date',
        ]);

        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        $this->residentRepository->update($request->all(), $id);
        Flash::success('Resident updated successfully.');

        return redirect(route('residents.index'));
    }

    // Delete a resident
    public function destroy($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        $this->residentRepository->delete($id);
        Flash::success('Resident deleted successfully.');

        return redirect(route('residents.index'));
    }

    // Profile view for a single resident
    public function profile($id)
    {
        $resident = Resident::with('diagnoses')->findOrFail($id);
        return view('residents.profile', compact('resident'));
    }

    // Custom resident dashboard
    public function showResidentDashboard($residentId)
    {
        $resident = Resident::find($residentId);

        if (!$resident) {
            return redirect()->route('home')->with('error', 'Resident not found.');
        }

        return view('resident.dashboard', compact('resident'));
    }
}
