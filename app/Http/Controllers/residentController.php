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

    /**
     * Display a listing of the resident.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $residents = $this->residentRepository->all();

        return view('residents.index')
            ->with('residents', $residents);
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
     * @param CreateresidentRequest $request
     *
     * @return Response
     */
    public function store(CreateresidentRequest $request)
    {
        $input = $request->all();

        $resident = $this->residentRepository->create($input);

        Flash::success('Resident saved successfully.');

        return redirect(route('residents.index'));
    }

    /**
     * Display the specified resident.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');

            return redirect(route('residents.index'));
        }

        return view('residents.show')->with('resident', $resident);
    }

    /**
     * Show the form for editing the specified resident.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $resident = $this->residentRepository->find($id);

        if (empty($resident)) {
            Flash::error('Resident not found');

            return redirect(route('residents.index'));
        }

        return view('residents.edit')->with('resident', $resident);
    }

    /**
     * Update the specified resident in storage.
     *
     * @param int $id
     * @param UpdateresidentRequest $request
     *
     * @return Response
     */
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

    /**
     * Remove the specified resident from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
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

    /**
     * Show the profile of a resident.
     *
     * @param int $id
     * @return Response
     */
    public function profile($id)
    {
        $resident = Resident::with(['diagnoses'])->findOrFail($id);
        return view('residents.profile', compact('resident'));
    }

    /**
     * Show Resident Dashboard.
     *
     * @param int $residentId
     * @return Response
     */
    public function showResidentDashboard($residentId)
    {
        // Fetch the resident data from the database
        $resident = Resident::find($residentId);
        
        if (!$resident) {
            return redirect()->route('home')->with('error', 'Resident not found.');
        }

        return view('resident.dashboard', compact('resident'));
    }

    /**
     * Update the medications and allergies of a resident.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
 public function updateMedications(Request $request, $id)
{
    $resident = Resident::findOrFail($id);

    $medications = array_filter(array_map('trim', $request->input('medications', [])));
    $allergies = array_filter(array_map('trim', $request->input('allergies', [])));

    $resident->medications = implode(', ', $medications);
    $resident->allergies = implode(', ', $allergies);
    $resident->save();
if ($request->ajax()) {
    return response()->json(['message' => 'Medications and allergies updated successfully.']);
}

return redirect()->back()->with('success', 'Medications and allergies updated successfully.');

}


    /**
     * Show the resident search page.
     *
     * @return Response
     */
    public function searchPage()
    {
        return view('residents.search');
    }

    /**
     * Show the search results for residents.
     *
     * @param Request $request
     * @return Response
     */
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

    /**
     * Show the Resident Hub with statistics.
     *
     * @return Response
     */
    public function showResidentHub()
    {
        $totalResidents = Resident::count();
        $newThisWeek = Resident::where('admissiondate', '>=', Carbon::now()->subDays(7))->count();
        $discharged = Resident::where('status', 'discharged')->count();

        return view('residentHub', compact('totalResidents', 'newThisWeek', 'discharged'));
    }
    
    
}
