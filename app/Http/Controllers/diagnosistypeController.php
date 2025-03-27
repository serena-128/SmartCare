<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatediagnosistypeRequest;
use App\Http\Requests\UpdatediagnosistypeRequest;
use App\Repositories\diagnosistypeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class diagnosistypeController extends AppBaseController
{
    /** @var diagnosistypeRepository $diagnosistypeRepository*/
    private $diagnosistypeRepository;

    public function __construct(diagnosistypeRepository $diagnosistypeRepo)
    {
        $this->diagnosistypeRepository = $diagnosistypeRepo;
    }

    /**
     * Display a listing of the diagnosistype.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $diagnosistypes = $this->diagnosistypeRepository->all();

        return view('diagnosistypes.index')
            ->with('diagnosistypes', $diagnosistypes);
    }

    /**
     * Show the form for creating a new diagnosistype.
     *
     * @return Response
     */
    public function create()
    {
        return view('diagnosistypes.create');
    }

    /**
     * Store a newly created diagnosistype in storage.
     *
     * @param CreatediagnosistypeRequest $request
     *
     * @return Response
     */
    public function store(CreatediagnosistypeRequest $request)
    {
        $input = $request->all();

        $diagnosistype = $this->diagnosistypeRepository->create($input);

        Flash::success('Diagnosistype saved successfully.');

        return redirect(route('diagnosistypes.index'));
    }

    /**
     * Display the specified diagnosistype.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $diagnosistype = $this->diagnosistypeRepository->find($id);

        if (empty($diagnosistype)) {
            Flash::error('Diagnosistype not found');

            return redirect(route('diagnosistypes.index'));
        }

        return view('diagnosistypes.show')->with('diagnosistype', $diagnosistype);
    }

    /**
     * Show the form for editing the specified diagnosistype.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $diagnosistype = $this->diagnosistypeRepository->find($id);

        if (empty($diagnosistype)) {
            Flash::error('Diagnosistype not found');

            return redirect(route('diagnosistypes.index'));
        }

        return view('diagnosistypes.edit')->with('diagnosistype', $diagnosistype);
    }

    /**
     * Update the specified diagnosistype in storage.
     *
     * @param int $id
     * @param UpdatediagnosistypeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatediagnosistypeRequest $request)
    {
        $diagnosistype = $this->diagnosistypeRepository->find($id);

        if (empty($diagnosistype)) {
            Flash::error('Diagnosistype not found');

            return redirect(route('diagnosistypes.index'));
        }

        $diagnosistype = $this->diagnosistypeRepository->update($request->all(), $id);

        Flash::success('Diagnosistype updated successfully.');

        return redirect(route('diagnosistypes.index'));
    }

    /**
     * Remove the specified diagnosistype from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $diagnosistype = $this->diagnosistypeRepository->find($id);

        if (empty($diagnosistype)) {
            Flash::error('Diagnosistype not found');

            return redirect(route('diagnosistypes.index'));
        }

        $this->diagnosistypeRepository->delete($id);

        Flash::success('Diagnosistype deleted successfully.');

        return redirect(route('diagnosistypes.index'));
    }
}
