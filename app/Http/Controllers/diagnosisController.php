<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatediagnosisRequest;
use App\Http\Requests\UpdatediagnosisRequest;
use App\Repositories\diagnosisRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class diagnosisController extends AppBaseController
{
    /** @var diagnosisRepository $diagnosisRepository*/
    private $diagnosisRepository;

    public function __construct(diagnosisRepository $diagnosisRepo)
    {
        $this->diagnosisRepository = $diagnosisRepo;
    }

    /**
     * Display a listing of the diagnosis.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $diagnoses = $this->diagnosisRepository->all();

        return view('diagnoses.index')
            ->with('diagnoses', $diagnoses);
    }

    /**
     * Show the form for creating a new diagnosis.
     *
     * @return Response
     */
    public function create()
    {
        return view('diagnoses.create');
    }

    /**
     * Store a newly created diagnosis in storage.
     *
     * @param CreatediagnosisRequest $request
     *
     * @return Response
     */
    public function store(CreatediagnosisRequest $request)
    {
        $input = $request->all();

        $diagnosis = $this->diagnosisRepository->create($input);

        Flash::success('Diagnosis saved successfully.');

        return redirect(route('diagnoses.index'));
    }

    /**
     * Display the specified diagnosis.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $diagnosis = $this->diagnosisRepository->find($id);

        if (empty($diagnosis)) {
            Flash::error('Diagnosis not found');

            return redirect(route('diagnoses.index'));
        }

        return view('diagnoses.show')->with('diagnosis', $diagnosis);
    }

    /**
     * Show the form for editing the specified diagnosis.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $diagnosis = $this->diagnosisRepository->find($id);

        if (empty($diagnosis)) {
            Flash::error('Diagnosis not found');

            return redirect(route('diagnoses.index'));
        }

        return view('diagnoses.edit')->with('diagnosis', $diagnosis);
    }

    /**
     * Update the specified diagnosis in storage.
     *
     * @param int $id
     * @param UpdatediagnosisRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatediagnosisRequest $request)
    {
        $diagnosis = $this->diagnosisRepository->find($id);

        if (empty($diagnosis)) {
            Flash::error('Diagnosis not found');

            return redirect(route('diagnoses.index'));
        }

        $diagnosis = $this->diagnosisRepository->update($request->all(), $id);

        Flash::success('Diagnosis updated successfully.');

        return redirect(route('diagnoses.index'));
    }

    /**
     * Remove the specified diagnosis from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $diagnosis = $this->diagnosisRepository->find($id);

        if (empty($diagnosis)) {
            Flash::error('Diagnosis not found');

            return redirect(route('diagnoses.index'));
        }

        $this->diagnosisRepository->delete($id);

        Flash::success('Diagnosis deleted successfully.');

        return redirect(route('diagnoses.index'));
    }
}
