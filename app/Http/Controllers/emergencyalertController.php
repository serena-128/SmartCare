<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateemergencyalertRequest;
use App\Http\Requests\UpdateemergencyalertRequest;
use App\Repositories\emergencyalertRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\EmergencyAlert;

use Flash;
use Response;

class EmergencyAlertController extends AppBaseController
{
    /** @var emergencyalertRepository $emergencyalertRepository */
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
        return view('emergencyalerts.create');
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
        $input = $request->all();

        $emergencyalert = $this->emergencyalertRepository->create($input);

        Flash::success('Emergency alert saved successfully.');

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
            Flash::error('Emergency alert not found');

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
            Flash::error('Emergency alert not found');

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
            Flash::error('Emergency alert not found');

            return redirect(route('emergencyalerts.index'));
        }

        $emergencyalert = $this->emergencyalertRepository->update($request->all(), $id);

        Flash::success('Emergency alert updated successfully.');

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
            Flash::error('Emergency alert not found');

            return redirect(route('emergencyalerts.index'));
        }

        $this->emergencyalertRepository->delete($id);

        Flash::success('Emergency alert deleted successfully.');

        return redirect(route('emergencyalerts.index'));
    }
}
