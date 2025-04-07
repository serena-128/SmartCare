<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedoseRequest;
use App\Http\Requests\UpdatedoseRequest;
use App\Repositories\doseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class doseController extends AppBaseController
{
    /** @var doseRepository $doseRepository*/
    private $doseRepository;

    public function __construct(doseRepository $doseRepo)
    {
        $this->doseRepository = $doseRepo;
    }

    /**
     * Display a listing of the dose.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $doses = $this->doseRepository->all();

        return view('doses.index')
            ->with('doses', $doses);
    }

    /**
     * Show the form for creating a new dose.
     *
     * @return Response
     */
    public function create()
    {
        return view('doses.create');
    }

    /**
     * Store a newly created dose in storage.
     *
     * @param CreatedoseRequest $request
     *
     * @return Response
     */
    public function store(CreatedoseRequest $request)
    {
        $input = $request->all();

        $dose = $this->doseRepository->create($input);

        Flash::success('Dose saved successfully.');

        return redirect(route('doses.index'));
    }

    /**
     * Display the specified dose.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dose = $this->doseRepository->find($id);

        if (empty($dose)) {
            Flash::error('Dose not found');

            return redirect(route('doses.index'));
        }

        return view('doses.show')->with('dose', $dose);
    }

    /**
     * Show the form for editing the specified dose.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dose = $this->doseRepository->find($id);

        if (empty($dose)) {
            Flash::error('Dose not found');

            return redirect(route('doses.index'));
        }

        return view('doses.edit')->with('dose', $dose);
    }

    /**
     * Update the specified dose in storage.
     *
     * @param int $id
     * @param UpdatedoseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedoseRequest $request)
    {
        $dose = $this->doseRepository->find($id);

        if (empty($dose)) {
            Flash::error('Dose not found');

            return redirect(route('doses.index'));
        }

        $dose = $this->doseRepository->update($request->all(), $id);

        Flash::success('Dose updated successfully.');

        return redirect(route('doses.index'));
    }

    /**
     * Remove the specified dose from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dose = $this->doseRepository->find($id);

        if (empty($dose)) {
            Flash::error('Dose not found');

            return redirect(route('doses.index'));
        }

        $this->doseRepository->delete($id);

        Flash::success('Dose deleted successfully.');

        return redirect(route('doses.index'));
    }
}
