<table class="table table-responsive" id="stafftasks-table">
    <thead>
        <th>Staffmemberid</th>
        <th>Taskid</th>
        <th>Roleintask</th>
        <th>Startdate</th>
        <th>Enddate</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($stafftasks as $stafftask)
        <tr>
            <td>{!! $stafftask->staffmemberid !!}</td>
            <td>{!! $stafftask->taskid !!}</td>
            <td>{!! $stafftask->roleintask !!}</td>
            <td>{!! $stafftask->startdate !!}</td>
            <td>{!! $stafftask->enddate !!}</td>
            <td>
                {!! Form::open(['route' => ['stafftasks.destroy', $stafftask->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('stafftasks.show', [$stafftask->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('stafftasks.edit', [$stafftask->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>