<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatestaffmemberRequest;
use App\Http\Requests\UpdatestaffmemberRequest;
use App\Repositories\staffmemberRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class staffmemberController extends AppBaseController
{
    /** @var staffmemberRepository $staffmemberRepository*/
    private $staffmemberRepository;

    public function __construct(staffmemberRepository $staffmemberRepo)
    {
        $this->staffmemberRepository = $staffmemberRepo;
    }

    /**
     * Display a listing of the staffmember.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $staffmembers = $this->staffmemberRepository->all();

        return view('staffmembers.index')
            ->with('staffmembers', $staffmembers);
    }

    /**
     * Show the form for creating a new staffmember.
     *
     * @return Response
     */
    public function create()
    {
        return view('staffmembers.create');
    }

    /**
     * Store a newly created staffmember in storage.
     *
     * @param CreatestaffmemberRequest $request
     *
     * @return Response
     */
    public function store(CreatestaffmemberRequest $request)
    {
        $input = $request->all();

        $staffmember = $this->staffmemberRepository->create($input);

        Flash::success('Staffmember saved successfully.');

        return redirect(route('staffmembers.index'));
    }

    /**
     * Display the specified staffmember.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $staffmember = $this->staffmemberRepository->find($id);

        if (empty($staffmember)) {
            Flash::error('Staffmember not found');

            return redirect(route('staffmembers.index'));
        }

        return view('staffmembers.show')->with('staffmember', $staffmember);
    }

    /**
     * Show the form for editing the specified staffmember.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $staffmember = $this->staffmemberRepository->find($id);

        if (empty($staffmember)) {
            Flash::error('Staffmember not found');

            return redirect(route('staffmembers.index'));
        }

        return view('staffmembers.edit')->with('staffmember', $staffmember);
    }

    /**
     * Update the specified staffmember in storage.
     *
     * @param int $id
     * @param UpdatestaffmemberRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestaffmemberRequest $request)
    {
        $staffmember = $this->staffmemberRepository->find($id);

        if (empty($staffmember)) {
            Flash::error('Staffmember not found');

            return redirect(route('staffmembers.index'));
        }

        $staffmember = $this->staffmemberRepository->update($request->all(), $id);

        Flash::success('Staffmember updated successfully.');

        return redirect(route('staffmembers.index'));
    }

    /**
     * Remove the specified staffmember from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $staffmember = $this->staffmemberRepository->find($id);

        if (empty($staffmember)) {
            Flash::error('Staffmember not found');

            return redirect(route('staffmembers.index'));
        }

        $this->staffmemberRepository->delete($id);

        Flash::success('Staffmember deleted successfully.');

        return redirect(route('staffmembers.index'));
    }
}
