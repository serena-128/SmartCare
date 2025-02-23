<?php

namespace App\Http\Controllers;

use App\Models\CarePlan;
use App\Http\Requests\CreateCarePlanRequest;
use App\Http\Requests\UpdateCarePlanRequest;
use App\Repositories\CarePlanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Flash;
use Response;

class CarePlanController extends Controller
{
    /** @var CarePlanRepository */
    private $carePlanRepository;

    public function __construct(CarePlanRepository $carePlanRepo)
    {
        $this->carePlanRepository = $carePlanRepo;

        // Ensure the role relationship is loaded for the authenticated user
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            $user->load('role'); // Eager load role for authorization checks
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        // Authorization check for viewing care plans
        $this->authorize('viewAny', CarePlan::class);

        // Get all care plans via the repository
        $carePlans = $this->carePlanRepository->all();

        // Return view with care plans
        return view('careplans.index', compact('carePlans'));
    }

    public function create()
    {
        // Authorization check for creating a care plan
        $this->authorize('create', CarePlan::class);

        // Return create view
        return view('careplans.create');
    }

    public function store(CreateCarePlanRequest $request)
    {
        // Authorization check for storing a care plan
        $this->authorize('create', CarePlan::class);

        // Create the care plan
        $this->carePlanRepository->create($request->all());

        // Redirect back to care plan index
        return redirect()->route('careplans.index')->with('success', 'Care plan created successfully.');
    }

    public function show($id)
    {
        // Find care plan by ID
        $carePlan = $this->carePlanRepository->find($id);

        // If care plan doesn't exist, redirect with error
        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        // Authorization check for viewing a specific care plan
        $this->authorize('view', $carePlan);

        // Return show view with care plan data
        return view('careplans.show', compact('carePlan'));
    }

    public function edit($id)
    {
        // Find care plan by ID
        $carePlan = $this->carePlanRepository->find($id);

        // If care plan doesn't exist, redirect with error
        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        // Authorization check for editing the care plan
        $this->authorize('update', $carePlan);

        // Return edit view with care plan data
        return view('careplans.edit', compact('carePlan'));
    }

    public function update(UpdateCarePlanRequest $request, $id)
    {
        // Find care plan by ID
        $carePlan = $this->carePlanRepository->find($id);

        // If care plan doesn't exist, redirect with error
        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        // Authorization check for updating the care plan
        $this->authorize('update', $carePlan);

        // Update the care plan
        $this->carePlanRepository->update($request->all(), $id);

        // Redirect back to care plan index
        return redirect()->route('careplans.index')->with('success', 'Care plan updated successfully.');
    }

    public function destroy($id)
    {
        // Find care plan by ID
        $carePlan = $this->carePlanRepository->find($id);

        // If care plan doesn't exist, redirect with error
        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        // Authorization check for deleting the care plan
        $this->authorize('delete', $carePlan);

        // Delete the care plan
        $this->carePlanRepository->delete($id);

        // Redirect back to care plan index
        return redirect()->route('careplans.index')->with('success', 'Care plan deleted successfully.');
    }
}
