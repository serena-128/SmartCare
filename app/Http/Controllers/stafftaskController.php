<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatestafftaskRequest;
use App\Http\Requests\UpdatestafftaskRequest;
use App\Repositories\stafftaskRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\StaffMember; // ✅ Add this line
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

    // ✅ Replace your current create() with this one:
    public function create()
{
    $staff = StaffMember::all(); // ✅ model name matches capitalization

    $staffMembers = $staff->mapWithKeys(function ($s) {
        return [$s->id => $s->firstname . ' ' . $s->lastname];
    });

    return view('stafftasks.create', compact('staffMembers'));
}

public function store(Request $request)
{
    $data = $request->validate([
        'staff_id' => 'required|exists:staffmember,id',
        'date' => 'required|date',
        'time' => 'required',
        'description' => 'nullable|string',
    ]);

    \App\Models\Stafftask::create($data);

    Flash::success('Task assigned to staff successfully.');
    return redirect()->route('stafftasks.index');
}
public function index()
{
    $stafftasks = \App\Models\Stafftask::with('staff')->latest()->get();
    return view('stafftasks.index', compact('stafftasks'));
}



    // ...rest of your methods...
}
