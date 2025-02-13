<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatedietaryrestrictionRequest;
use App\Http\Requests\UpdatedietaryrestrictionRequest;
use App\Repositories\dietaryrestrictionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class dietaryrestrictionController extends AppBaseController
{
    /** @var dietaryrestrictionRepository $dietaryrestrictionRepository*/
    private $dietaryrestrictionRepository;

    public function __construct(dietaryrestrictionRepository $dietaryrestrictionRepo)
    {
        $this->dietaryrestrictionRepository = $dietaryrestrictionRepo;
    }

    /**
     * Display a listing of the dietaryrestriction.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $dietaryrestrictions = $this->dietaryrestrictionRepository->all();

        return view('dietaryrestrictions.index')
            ->with('dietaryrestrictions', $dietaryrestrictions);
    }

    /**
     * Show the form for creating a new dietaryrestriction.
     *
     * @return Response
     */
    public function create()
    {
        return view('dietaryrestrictions.create');
    }

    /**
     * Store a newly created dietaryrestriction in storage.
     *
     * @param CreatedietaryrestrictionRequest $request
     *
     * @return Response
     */
    public function store(CreatedietaryrestrictionRequest $request)
    {
        $input = $request->all();

        $dietaryrestriction = $this->dietaryrestrictionRepository->create($input);

        Flash::success('Dietaryrestriction saved successfully.');

        return redirect(route('dietaryrestrictions.index'));
    }

    /**
     * Display the specified dietaryrestriction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $dietaryrestriction = $this->dietaryrestrictionRepository->find($id);

        if (empty($dietaryrestriction)) {
            Flash::error('Dietaryrestriction not found');

            return redirect(route('dietaryrestrictions.index'));
        }

        return view('dietaryrestrictions.show')->with('dietaryrestriction', $dietaryrestriction);
    }

    /**
     * Show the form for editing the specified dietaryrestriction.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $dietaryrestriction = $this->dietaryrestrictionRepository->find($id);

        if (empty($dietaryrestriction)) {
            Flash::error('Dietaryrestriction not found');

            return redirect(route('dietaryrestrictions.index'));
        }

        return view('dietaryrestrictions.edit')->with('dietaryrestriction', $dietaryrestriction);
    }

    /**
     * Update the specified dietaryrestriction in storage.
     *
     * @param int $id
     * @param UpdatedietaryrestrictionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedietaryrestrictionRequest $request)
    {
        $dietaryrestriction = $this->dietaryrestrictionRepository->find($id);

        if (empty($dietaryrestriction)) {
            Flash::error('Dietaryrestriction not found');

            return redirect(route('dietaryrestrictions.index'));
        }

        $dietaryrestriction = $this->dietaryrestrictionRepository->update($request->all(), $id);

        Flash::success('Dietaryrestriction updated successfully.');

        return redirect(route('dietaryrestrictions.index'));
    }

    /**
     * Remove the specified dietaryrestriction from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $dietaryrestriction = $this->dietaryrestrictionRepository->find($id);

        if (empty($dietaryrestriction)) {
            Flash::error('Dietaryrestriction not found');

            return redirect(route('dietaryrestrictions.index'));
        }

        $this->dietaryrestrictionRepository->delete($id);

        Flash::success('Dietaryrestriction deleted successfully.');

        return redirect(route('dietaryrestrictions.index'));
    }
}
