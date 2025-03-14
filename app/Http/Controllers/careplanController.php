<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecareplanRequest;
use App\Http\Requests\UpdatecareplanRequest;
use App\Repositories\CareplanRepository;
use App\Models\CarePlan; // ✅ Add CarePlan model
use App\Models\Resident; // ✅ Add Resident model
use App\Models\StaffMember; // ✅ Add StaffMember model
use Illuminate\Http\Request;
use Flash;
use Response;

class CarePlanController extends AppBaseController
{
    /** @var CarePlanRepository */
    private $careplanRepository;

    public function __construct(CareplanRepository $careplanRepo)
    {
        $this->careplanRepository = $careplanRepo;
    }

    /**
     * Display a listing of the careplan.
     */
    public function index(Request $request)
    {
        $careplans = $this->careplanRepository->all();

        return view('careplans.index')->with('careplans', $careplans);
    }

    /**
     * Show the form for creating a new careplan.
     */
public function create()
{
    $residents = Resident::all(); // Fetch all residents
    $staffMembers = StaffMember::all(); // Fetch all staff members

    return view('careplans.create', compact('residents', 'staffMembers'));
}


    /**
     * Store a newly created careplan in storage.
     */
    public function store(CreatecareplanRequest $request)
    {
        $input = $request->all();
        $careplan = $this->careplanRepository->create($input);

        Flash::success('Careplan saved successfully.');

        return redirect(route('careplans.index'));
    }

    /**
     * Show the specified careplan.
     */
public function show($id)
{
    $careplan = CarePlan::with(['resident', 'staffMember'])->find($id);

    if (!$careplan) {
        Flash::error('Careplan not found');
        return redirect(route('careplans.index'));
    }

    return view('careplans.show', compact('careplan'));
}


    /**
     * Show the form for editing the specified careplan.
     */
    public function edit($id)
    {
        $careplan = CarePlan::findOrFail($id);
        $residents = Resident::all(); // ✅ Fetch all residents
        $staffMembers = StaffMember::all(); // ✅ Fetch all staff members

        return view('careplans.edit', compact('careplan', 'residents', 'staffMembers'));
    }

    /**
     * Update the specified careplan in storage.
     */
    public function update($id, UpdatecareplanRequest $request)
    {
        $careplan = $this->careplanRepository->find($id);

        if (empty($careplan)) {
            Flash::error('Careplan not found');
            return redirect(route('careplans.index'));
        }

        $careplan = $this->careplanRepository->update($request->all(), $id);

        Flash::success('Careplan updated successfully.');

        return redirect(route('careplans.index'));
    }

    /**
     * Remove the specified careplan from storage.
     */
    public function destroy($id)
    {
        $careplan = $this->careplanRepository->find($id);

        if (empty($careplan)) {
            Flash::error('Careplan not found');
            return redirect(route('careplans.index'));
        }

        $this->careplanRepository->delete($id);

        Flash::success('Careplan deleted successfully.');

        return redirect(route('careplans.index'));
    }
}
