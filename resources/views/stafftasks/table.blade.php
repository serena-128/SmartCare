<table class="table table-responsive" id="stafftasks-table">
    <thead>
        <tr>
            <th>Assigned Staff</th>
            <th>Task</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($stafftasks as $stafftask)
        <tr>
            <td>
                {{ $stafftask->staff->firstname ?? 'N/A' }} {{ $stafftask->staff->lastname ?? '' }}
            </td>
            <td>{{ $stafftask->roleintask }}</td>
            <td>{{ \Carbon\Carbon::parse($stafftask->startdate)->format('Y-m-d') }}</td>
            <td>{{ \Carbon\Carbon::parse($stafftask->enddate)->format('Y-m-d') }}</td>
            <td>
                {!! Form::open(['route' => ['stafftasks.destroy', $stafftask->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{{ route('stafftasks.show', [$stafftask->id]) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-eye"></i>
                    </a>
                    <a href="{{ route('stafftasks.edit', [$stafftask->id]) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-edit"></i>
                    </a>
                    {!! Form::button('<i class="far fa-trash-alt"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('Are you sure?')"
                    ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
