<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateemergencyalertRequest;
use App\Http\Requests\UpdateemergencyalertRequest;
use App\Repositories\emergencyalertRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\emergencyalert;
use App\Models\StaffMember;

use Flash;
use Response;

class emergencyalertController extends AppBaseController
{
    /** @var emergencyalertRepository $emergencyalertRepository*/
    private $emergencyalertRepository;

    public function __construct(emergencyalertRepository $emergencyalertRepo)
    {
        $this->emergencyalertRepository = $emergencyalertRepo;
    }

    /**
     * Display a listing of the emergencyalert.
     *
     * @param Request $request
     *
     * @return Response
     */
public function index(Request $request)
{
    $query = EmergencyAlert::with(['resident', 'triggeredBy', 'resolvedBy', 'inProgressBy']);

    // If filtering by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Sort: Pending > In Progress > Resolved
    $emergencyalerts = $query
        ->orderByRaw("FIELD(status, 'Pending', 'In Progress', 'Resolved')")
        ->get();

    return view('emergencyalerts.index', compact('emergencyalerts'));
}

    /**
     * Show the form for creating a new emergencyalert.
     *
     * @return Response
     */
    public function create()
{
    $residents = \App\Models\Resident::select('id', 'firstname', 'lastname')
        ->get()
        ->mapWithKeys(function ($resident) {
            return [$resident->id => $resident->firstname . ' ' . $resident->lastname];
        });

    return view('emergencyalerts.create', compact('residents'));
}

    

    /**
     * Store a newly created emergencyalert in storage.
     *
     * @param CreateemergencyalertRequest $request
     *
     * @return Response
     */
    
public function store(CreateemergencyalertRequest $request)
{
    $input = $request->validated();

    $input['triggeredbyid'] = session('staff_id');
    $input['alerttimestamp'] = now();
    $input['status'] = 'Pending';

    $emergencyalert = $this->emergencyalertRepository->create($input);

    $staff = \App\Models\StaffMember::all();

    Flash::success('Emergency Alert created and notifications sent to staff.');

    return redirect(route('emergencyalerts.index'));
}



    /**
     * Display the specified emergencyalert.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergencyalert not found');

            return redirect(route('emergencyalerts.index'));
        }

        return view('emergencyalerts.show')->with('emergencyalert', $emergencyalert);
    }

    /**
     * Show the form for editing the specified emergencyalert.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergencyalert not found');

            return redirect(route('emergencyalerts.index'));
        }

        return view('emergencyalerts.edit')->with('emergencyalert', $emergencyalert);
    }

    /**
     * Update the specified emergencyalert in storage.
     *
     * @param int $id
     * @param UpdateemergencyalertRequest $request
     *
     * @return Response
     */
   public function update($id, UpdateemergencyalertRequest $request)
{
    $emergencyalert = $this->emergencyalertRepository->find($id);

    if (empty($emergencyalert)) {
        if ($request->ajax()) {
            return response()->json(['message' => 'Alert not found'], 404);
        }
        Flash::error('Emergencyalert not found');
        return redirect(route('emergencyalerts.index'));
    }

    $this->emergencyalertRepository->update($request->all(), $id);

    if ($request->ajax()) {
        return response()->json(['message' => 'Emergencyalert updated successfully.']);
    }

    Flash::success('Emergencyalert updated successfully.');
    return redirect(route('emergencyalerts.index'));
}

    /**
     * Remove the specified emergencyalert from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergencyalert not found');

            return redirect(route('emergencyalerts.index'));
        }

        $this->emergencyalertRepository->delete($id);

        Flash::success('Emergencyalert deleted successfully.');

        return redirect(route('emergencyalerts.index'));
    }
public function showEmergencyAlertsHub()
{
    $totalAlerts = EmergencyAlert::count();
    $activeAlerts = EmergencyAlert::where('status', 'active')->count();
    $resolvedAlerts = EmergencyAlert::where('status', 'resolved')->count(); // Ensure this is calculated and passed

    return view('emergencyalertshub', compact('totalAlerts', 'activeAlerts', 'resolvedAlerts'));
}

public function resolve($id, Request $request)
{
    $alert = EmergencyAlert::findOrFail($id);
    $alert->status = 'Resolved';
    $alert->resolvedbyid = $request->input('resolvedbyid');
    $alert->inprogressbyid = null; // ✅ clear this when resolved
    $alert->save();

    return response()->json(['message' => 'Alert marked as resolved.']);
}


public function markInProgress($id, Request $request)
{
    $alert = EmergencyAlert::findOrFail($id);
    $alert->status = 'In Progress';
    $alert->inprogressbyid = $request->input('staff_id'); // set staff handling it
    $alert->save();

    return response()->json(['message' => 'Alert marked as In Progress.']);
}


}
