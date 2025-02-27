<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateresidentRequest;
use App\Http\Requests\UpdateresidentRequest;
use App\Repositories\residentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Resident;


class residentController extends AppBaseController
{
    /** @var residentRepository $residentRepository*/
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
    public function profile($id)
{
    $resident = Resident::with(['diagnoses'])->findOrFail($id);
    return view('residents.profile', compact('resident'));
}
    

}
