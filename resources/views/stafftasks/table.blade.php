<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">📋 Tasks</h4>
        <a href="{{ route('stafftasks.create') }}" class="btn btn-success">
            ➕ Add New Task
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle" id="stafftasks-table">
            <thead class="table-light">
                <tr>
                    <th>👤 Staff Member</th>
                    <th>📅 Date</th>
                    <th>⏰ Time</th>
                    <th>📝 Description</th>
                    <th class="text-end">⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stafftasks as $stafftask)
                    <tr>
                        <td>{{ $stafftask->staff->firstname }} {{ $stafftask->staff->lastname }}</td>
                        <td>{{ \Carbon\Carbon::parse($stafftask->date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($stafftask->time)->format('H:i') }}</td>
                        <td>{{ $stafftask->description }}</td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('stafftasks.edit', $stafftask->id) }}" class="btn btn-outline-primary" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                {!! Form::open(['route' => ['stafftasks.destroy', $stafftask->id], 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure you want to delete this task?")', 'style' => 'display:inline-block']) !!}
                                    <button type="submit" class="btn btn-outline-danger" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
