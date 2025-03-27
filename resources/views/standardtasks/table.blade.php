<table class="table table-responsive" id="standardtasks-table">
    <thead>
        <th>Assignedto</th>
        <th>Description</th>
        <th>Duedate</th>
        <th>Prioritylevel</th>
        <th>Completedby</th>
        <th>Completiondatetime</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($standardtasks as $standardtask)
        <tr>
            <td>{!! $standardtask->assignedto !!}</td>
            <td>{!! $standardtask->description !!}</td>
            <td>{!! $standardtask->duedate !!}</td>
            <td>{!! $standardtask->prioritylevel !!}</td>
            <td>{!! $standardtask->completedby !!}</td>
            <td>{!! $standardtask->completiondatetime !!}</td>
            <td>
                {!! Form::open(['route' => ['standardtasks.destroy', $standardtask->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('standardtasks.show', [$standardtask->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('standardtasks.edit', [$standardtask->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>