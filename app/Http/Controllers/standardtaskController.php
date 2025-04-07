<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatestandardtaskRequest;
use App\Http\Requests\UpdatestandardtaskRequest;
use App\Repositories\standardtaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class standardtaskController extends AppBaseController
{
    /** @var standardtaskRepository $standardtaskRepository*/
    private $standardtaskRepository;

    public function __construct(standardtaskRepository $standardtaskRepo)
    {
        $this->standardtaskRepository = $standardtaskRepo;
    }

    /**
     * Display a listing of the standardtask.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $standardtasks = $this->standardtaskRepository->all();

        return view('standardtasks.index')
            ->with('standardtasks', $standardtasks);
    }

    /**
     * Show the form for creating a new standardtask.
     *
     * @return Response
     */
    public function create()
    {
        return view('standardtasks.create');
    }

    /**
     * Store a newly created standardtask in storage.
     *
     * @param CreatestandardtaskRequest $request
     *
     * @return Response
     */
    public function store(CreatestandardtaskRequest $request)
    {
        $input = $request->all();

        $standardtask = $this->standardtaskRepository->create($input);

        Flash::success('Standardtask saved successfully.');

        return redirect(route('standardtasks.index'));
    }

    /**
     * Display the specified standardtask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $standardtask = $this->standardtaskRepository->find($id);

        if (empty($standardtask)) {
            Flash::error('Standardtask not found');

            return redirect(route('standardtasks.index'));
        }

        return view('standardtasks.show')->with('standardtask', $standardtask);
    }

    /**
     * Show the form for editing the specified standardtask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $standardtask = $this->standardtaskRepository->find($id);

        if (empty($standardtask)) {
            Flash::error('Standardtask not found');

            return redirect(route('standardtasks.index'));
        }

        return view('standardtasks.edit')->with('standardtask', $standardtask);
    }

    /**
     * Update the specified standardtask in storage.
     *
     * @param int $id
     * @param UpdatestandardtaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestandardtaskRequest $request)
    {
        $standardtask = $this->standardtaskRepository->find($id);

        if (empty($standardtask)) {
            Flash::error('Standardtask not found');

            return redirect(route('standardtasks.index'));
        }

        $standardtask = $this->standardtaskRepository->update($request->all(), $id);

        Flash::success('Standardtask updated successfully.');

        return redirect(route('standardtasks.index'));
    }

    /**
     * Remove the specified standardtask from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $standardtask = $this->standardtaskRepository->find($id);

        if (empty($standardtask)) {
            Flash::error('Standardtask not found');

            return redirect(route('standardtasks.index'));
        }

        $this->standardtaskRepository->delete($id);

        Flash::success('Standardtask deleted successfully.');

        return redirect(route('standardtasks.index'));
    }
}
