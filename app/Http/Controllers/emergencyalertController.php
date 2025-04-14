<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateemergencyalertRequest;
use App\Http\Requests\UpdateemergencyalertRequest;
use App\Repositories\emergencyalertRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\emergencyalert;
use App\Models\StaffMember;
use App\Notifications\EmergencyAlertNotification;
use Illuminate\Support\Facades\Notification;

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
public function index()
{
    // Fetch all emergency alerts
    $emergencyalerts = EmergencyAlert::with(['resident', 'triggeredBy', 'resolvedBy'])->get();

    // Pass to the view
    return view('emergencyalerts.index', compact('emergencyalerts'));
}

    /**
     * Show the form for creating a new emergencyalert.
     *
     * @return Response
     */
    public function create()
    {
        $residents = \App\Models\Resident::pluck('firstname', 'id');
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
         // Step 1: Get validated data
         $input = $request->validated();
     
         // Step 2: Set required system fields
         $input['triggeredbyid'] = session('staff_id'); // current logged-in staff
         $input['alerttimestamp'] = now();
         $input['status'] = 'Pending'; // default status
     
         // Step 3: Create the emergency alert
         $emergencyalert = $this->emergencyalertRepository->create($input);
     
         // Step 4: Notify all staff
         $staff = \App\Models\StaffMember::all();
         \Illuminate\Support\Facades\Notification::send($staff, new \App\Notifications\EmergencyAlertNotification($emergencyalert));
     
         // Step 5: Feedback
         \Flash::success('Emergency Alert created and notifications sent to staff.');
     
         // Step 6: Redirect
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
            Flash::error('Emergencyalert not found');

            return redirect(route('emergencyalerts.index'));
        }

        $emergencyalert = $this->emergencyalertRepository->update($request->all(), $id);

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

}
