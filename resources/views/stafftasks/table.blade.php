<table class="table table-responsive" id="stafftasks-table">
    <thead>
        <tr>
            <th>Staff Member</th>
            <th>Date</th>
            <th>Time</th>
            <th>Description</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stafftasks as $stafftask)
            <tr>
                <td>{{ $stafftask->staff->firstname }} {{ $stafftask->staff->lastname }}</td>
                <td>{{ $stafftask->date }}</td>
                <td>{{ $stafftask->time }}</td>
                <td>{{ $stafftask->description }}</td>
                <td>
                    {!! Form::open(['route' => ['stafftasks.destroy', $stafftask->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('stafftasks.show', $stafftask->id) }}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></a>
                        <a href="{{ route('stafftasks.edit', $stafftask->id) }}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
