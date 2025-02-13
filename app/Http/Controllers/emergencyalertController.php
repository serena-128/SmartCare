<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateemergencyalertRequest;
use App\Http\Requests\UpdateemergencyalertRequest;
use App\Repositories\emergencyalertRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class EmergencyAlertController extends AppBaseController
{
    /** @var emergencyalertRepository */
    private $emergencyalertRepository;

    public function __construct(emergencyalertRepository $emergencyalertRepo)
    {
        $this->middleware('auth'); // Ensure user is logged in
        $this->middleware('role:Nurse,Doctor')->only(['create', 'store']); // Only Nurses & Doctors can create alerts
        $this->middleware('role:Admin')->only(['edit', 'destroy']); // Only Admins can edit/delete alerts
        
        $this->emergencyalertRepository = $emergencyalertRepo;
    }

    /**
     * Display a listing of the emergencyalert.
     */
    public function index(Request $request)
    {
        $query = $this->emergencyalertRepository->query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('resident', function ($q) use ($search) {
                $q->where('firstname', 'LIKE', "%$search%")
                  ->orWhere('lastname', 'LIKE', "%$search%")
                  ->orWhere('roomnumber', 'LIKE', "%$search%");
            });
        }

        $emergencyalerts = $query->paginate(10);
        return view('emergencyalerts.index')->with('emergencyalerts', $emergencyalerts);
    }

    /**
     * Show the form for creating a new emergencyalert.
     */
    public function create()
    {
        return view('emergencyalerts.create');
    }

    /**
     * Store a newly created emergencyalert.
     */
    public function store(CreateemergencyalertRequest $request)
    {
        $input = $request->all();
        $input['triggeredbyid'] = auth()->user()->id; // Store logged-in user ID
        $input['status'] = 'In Progress';

        $emergencyalert = $this->emergencyalertRepository->create($input);

        Flash::success('Emergency Alert successfully sent!');
        return redirect(route('emergencyalerts.index'));
    }

    /**
     * Display the specified emergencyalert.
     */
    public function show($id)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergency Alert not found');
            return redirect(route('emergencyalerts.index'));
        }

        return view('emergencyalerts.show')->with('emergencyalert', $emergencyalert);
    }

    /**
     * Show the form for editing the specified emergencyalert.
     */
    public function edit($id)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergency Alert not found');
            return redirect(route('emergencyalerts.index'));
        }

        return view('emergencyalerts.edit')->with('emergencyalert', $emergencyalert);
    }

    /**
     * Update the specified emergencyalert in storage.
     */
    public function update($id, UpdateemergencyalertRequest $request)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergency Alert not found');
            return redirect(route('emergencyalerts.index'));
        }

        $emergencyalert = $this->emergencyalertRepository->update($request->all(), $id);
        Flash::success('Emergency Alert updated successfully.');
        return redirect(route('emergencyalerts.index'));
    }

    /**
     * Mark an emergency alert as resolved.
     */
    public function markAsResolved($id)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergency Alert not found');
            return redirect(route('emergencyalerts.index'));
        }

        $emergencyalert->update(['status' => 'Resolved']);
        Flash::success('Emergency Alert marked as resolved.');
        return redirect()->back();
    }

    /**
     * Remove the specified emergencyalert from storage.
     */
    public function destroy($id)
    {
        $emergencyalert = $this->emergencyalertRepository->find($id);

        if (empty($emergencyalert)) {
            Flash::error('Emergency Alert not found');
            return redirect(route('emergencyalerts.index'));
        }

        $this->emergencyalertRepository->delete($id);
        Flash::success('Emergency Alert deleted successfully.');
        return redirect(route('emergencyalerts.index'));
    }
}
