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
// ✅ Correct:
use App\Models\Stafftask;

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
public function daily()
{
    $staffId = session('staff_id');

    $tasks = \App\Models\Stafftask::where('staff_id', $staffId)
        ->whereDate('date', today())
        ->get()
        ->map(function ($task) {
    return [
        'id' => $task->id, // ✅ Add this line
        'title' => $task->description ?? 'Task',
        'start' => $task->date . 'T' . $task->time,
        'end'   => $task->date . 'T' . date('H:i', strtotime($task->time . ' +1 hour')),
        'status' => $task->status, // ✅ THIS IS CRUCIAL
    ];
});


    return view('staff.daily_tasks', ['tasksJson' => $tasks->toJson()]);
}


public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Uncompleted,In Progress,Completed',
    ]);

    $task = \App\Models\Stafftask::find($id);

    if (!$task) {
        return response()->json(['success' => false, 'message' => 'Task not found.'], 404);
    }

    $task->status = $request->status;
    $task->save();

    return response()->json(['success' => true]);
}

    // GET: Return task as JSON for the modal
public function edit($id)
{
    $task = Stafftask::findOrFail($id);
    return response()->json($task);
}

// PUT/PATCH: Update task via AJAX
public function update(Request $request, $id)
{
    $request->validate([
        'date' => 'required|date',
        'time' => 'required',
        'description' => 'nullable|string',
    ]);

    $task = Stafftask::findOrFail($id);
    $task->update($request->only(['date', 'time', 'description']));

    return response()->json(['success' => true]);
}
public function destroy($id)
{
    $task = Stafftask::findOrFail($id);
    $task->delete();

    return response()->json(['success' => true]);
}

}
