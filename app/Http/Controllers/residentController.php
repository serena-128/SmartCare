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

    public function index(Request $request)
    {
        $residents = $this->residentRepository->all();
        return view('residents.index', compact('residents'));
    }

    public function create()
    {
        return view('residents.create');
    }

    public function store(Request $request)
    {
        $resident = $this->residentRepository->create($request->all());
        Flash::success('Resident saved successfully.');
        return redirect(route('residents.index'));
    }

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

    public function edit($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        return view('residents.edit', compact('resident'));
    }

    public function update(Request $request, $id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        $this->residentRepository->update($request->all(), $id);
        Flash::success('Resident updated successfully.');

        return redirect(route('residents.index'));
    }

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

    public function profile($id)
    {
        $resident = Resident::with('diagnoses')->findOrFail($id);
        return view('residents.profile', compact('resident'));
    }

    public function showResidentDashboard($residentId)
    {
        $resident = Resident::find($residentId);

        if (!$resident) {
            return redirect()->route('home')->with('error', 'Resident not found.');
        }

        return view('resident.dashboard', compact('resident'));
    }
}