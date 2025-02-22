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
    }

    public function index(Request $request)
    {
        // Only managers and authorized staff can view care plans
        $this->authorize('viewAny', CarePlan::class);

        $carePlans = $this->carePlanRepository->all();
        return view('careplans.index', compact('carePlans'));
    }

    public function create()
    {
        // Only managers can create care plans
        $this->authorize('create', CarePlan::class);

        return view('careplans.create');
    }

    public function store(CreateCarePlanRequest $request)
    {
        $this->authorize('create', CarePlan::class);

        $this->carePlanRepository->create($request->all());

        return redirect()->route('careplans.index')->with('success', 'Care plan created successfully.');
    }

    public function show($id)
    {
        $carePlan = $this->carePlanRepository->find($id);
        
        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        $this->authorize('view', $carePlan);

        return view('careplans.show', compact('carePlan'));
    }

    public function edit($id)
    {
        $carePlan = $this->carePlanRepository->find($id);

        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        $this->authorize('update', $carePlan);

        return view('careplans.edit', compact('carePlan'));
    }

    public function update(UpdateCarePlanRequest $request, $id)
    {
        $carePlan = $this->carePlanRepository->find($id);

        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        $this->authorize('update', $carePlan);

        $this->carePlanRepository->update($request->all(), $id);

        return redirect()->route('careplans.index')->with('success', 'Care plan updated successfully.');
    }

    public function destroy($id)
    {
        $carePlan = $this->carePlanRepository->find($id);

        if (!$carePlan) {
            return redirect()->route('careplans.index')->with('error', 'Care plan not found.');
        }

        $this->authorize('delete', $carePlan);

        $this->carePlanRepository->delete($id);

        return redirect()->route('careplans.index')->with('success', 'Care plan deleted successfully.');
    }
}

