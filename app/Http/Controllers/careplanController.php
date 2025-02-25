<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecareplanRequest;
use App\Http\Requests\UpdatecareplanRequest;
use App\Repositories\careplanRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class careplanController extends AppBaseController
{
    /** @var careplanRepository $careplanRepository*/
    private $careplanRepository;

    public function __construct(careplanRepository $careplanRepo)
    {
        $this->careplanRepository = $careplanRepo;
    }

    /**
     * Display a listing of the careplan.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $careplans = $this->careplanRepository->all();

        return view('careplans.index')
            ->with('careplans', $careplans);
    }

    /**
     * Show the form for creating a new careplan.
     *
     * @return Response
     */
    public function create()
    {
        return view('careplans.create');
    }

    /**
     * Store a newly created careplan in storage.
     *
     * @param CreatecareplanRequest $request
     *
     * @return Response
     */
    public function store(CreatecareplanRequest $request)
    {
        $input = $request->all();

        $careplan = $this->careplanRepository->create($input);

        Flash::success('Careplan saved successfully.');

        return redirect(route('careplans.index'));
    }

    /**
     * Display the specified careplan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $careplan = $this->careplanRepository->find($id);

        if (empty($careplan)) {
            Flash::error('Careplan not found');

            return redirect(route('careplans.index'));
        }

        return view('careplans.show')->with('careplan', $careplan);
    }

    /**
     * Show the form for editing the specified careplan.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $careplan = $this->careplanRepository->find($id);

        if (empty($careplan)) {
            Flash::error('Careplan not found');

            return redirect(route('careplans.index'));
        }

        return view('careplans.edit')->with('careplan', $careplan);
    }

    /**
     * Update the specified careplan in storage.
     *
     * @param int $id
     * @param UpdatecareplanRequest $request
     *
     * @return Response
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
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
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
