<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatestafftaskRequest;
use App\Http\Requests\UpdatestafftaskRequest;
use App\Repositories\stafftaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class stafftaskController extends AppBaseController
{
    /** @var stafftaskRepository $stafftaskRepository*/
    private $stafftaskRepository;

    public function __construct(stafftaskRepository $stafftaskRepo)
    {
        $this->stafftaskRepository = $stafftaskRepo;
    }

    /**
     * Display a listing of the stafftask.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $stafftasks = $this->stafftaskRepository->all();

        return view('stafftasks.index')
            ->with('stafftasks', $stafftasks);
    }

    /**
     * Show the form for creating a new stafftask.
     *
     * @return Response
     */
    public function create()
    {
        return view('stafftasks.create');
    }

    /**
     * Store a newly created stafftask in storage.
     *
     * @param CreatestafftaskRequest $request
     *
     * @return Response
     */
    public function store(CreatestafftaskRequest $request)
    {
        $input = $request->all();

        $stafftask = $this->stafftaskRepository->create($input);

        Flash::success('Stafftask saved successfully.');

        return redirect(route('stafftasks.index'));
    }

    /**
     * Display the specified stafftask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stafftask = $this->stafftaskRepository->find($id);

        if (empty($stafftask)) {
            Flash::error('Stafftask not found');

            return redirect(route('stafftasks.index'));
        }

        return view('stafftasks.show')->with('stafftask', $stafftask);
    }

    /**
     * Show the form for editing the specified stafftask.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stafftask = $this->stafftaskRepository->find($id);

        if (empty($stafftask)) {
            Flash::error('Stafftask not found');

            return redirect(route('stafftasks.index'));
        }

        return view('stafftasks.edit')->with('stafftask', $stafftask);
    }

    /**
     * Update the specified stafftask in storage.
     *
     * @param int $id
     * @param UpdatestafftaskRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestafftaskRequest $request)
    {
        $stafftask = $this->stafftaskRepository->find($id);

        if (empty($stafftask)) {
            Flash::error('Stafftask not found');

            return redirect(route('stafftasks.index'));
        }

        $stafftask = $this->stafftaskRepository->update($request->all(), $id);

        Flash::success('Stafftask updated successfully.');

        return redirect(route('stafftasks.index'));
    }

    /**
     * Remove the specified stafftask from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stafftask = $this->stafftaskRepository->find($id);

        if (empty($stafftask)) {
            Flash::error('Stafftask not found');

            return redirect(route('stafftasks.index'));
        }

        $this->stafftaskRepository->delete($id);

        Flash::success('Stafftask deleted successfully.');

        return redirect(route('stafftasks.index'));
    }
}
