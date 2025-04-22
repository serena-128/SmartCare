<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateresidentRequest;
use App\Http\Requests\UpdateresidentRequest;
use App\Repositories\residentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Flash;
use Response;
use App\Models\Resident;

class residentController extends AppBaseController
{
    /** @var residentRepository $residentRepository */
    private $residentRepository;

    public function __construct(residentRepository $residentRepo)
    {
        $this->residentRepository = $residentRepo;
    }

    public function index(Request $request)
    {
        $residents = $this->residentRepository->all();

        return view('residents.index')->with('residents', $residents);
    }

    public function create()
    {
        return view('residents.create');
    }

    public function store(CreateresidentRequest $request)
    {
        $input = $request->all();

        $resident = $this->residentRepository->create($input);

        Flash::success('Resident saved successfully.');

        return redirect(route('residents.index'));
    }

    public function show($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        return view('residents.show')->with('resident', $resident);
    }

    public function edit($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        return view('residents.edit')->with('resident', $resident);
    }

    public function update($id, UpdateresidentRequest $request)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');
            return redirect(route('residents.index'));
        }

        $resident = $this->residentRepository->update($request->all(), $id);

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
        $resident = Resident::with(['diagnoses'])->findOrFail($id);
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

    public function searchPage()
    {
        return view('residents.search');
    }

    public function searchResults(Request $request)
    {
        $query = $request->input('query');

        $results = Resident::where('firstname', 'LIKE', "%$query%")
            ->orWhere('lastname', 'LIKE', "%$query%")
            ->orWhere('roomnumber', 'LIKE', "%$query%")
            ->orWhere('dateofbirth', 'LIKE', "%$query%")
            ->get();

        return view('residents.search', compact('results'));
    }

    public function showResidentHub()
    {
        $totalResidents = Resident::count();
        $newThisWeek = Resident::where('admissiondate', '>=', Carbon::now()->subDays(7))->count();
        $discharged = Resident::where('status', 'discharged')->count();

        return view('residentHub', compact('totalResidents', 'newThisWeek', 'discharged'));
    }

    public function updateMedications(Request $request, $id)
    {
        $request->validate([
            'medications' => 'nullable|string|max:255',
            'allergies' => 'nullable|string|max:255',
        ]);

        $resident = Resident::findOrFail($id);
        $resident->medications = $request->medications;
        $resident->allergies = $request->allergies;
        $resident->save();

        return back()->with('success', 'Resident details updated!');
    }
}
