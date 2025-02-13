<table class="table table-responsive" id="emergencyalerts-table">
    <thead>
        <th>Residentid</th>
        <th>Triggeredbyid</th>
        <th>Alerttype</th>
        <th>Alerttimestamp</th>
        <th>Status</th>
        <th>Resolvedbyid</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($emergencyalerts as $emergencyalert)
        <tr>
            <td>{!! $emergencyalert->residentid !!}</td>
            <td>{!! $emergencyalert->triggeredbyid !!}</td>
            <td>{!! $emergencyalert->alerttype !!}</td>
            <td>{!! $emergencyalert->alerttimestamp !!}</td>
            <td>{!! $emergencyalert->status !!}</td>
            <td>{!! $emergencyalert->resolvedbyid !!}</td>
            <td>
                {!! Form::open(['route' => ['emergencyalerts.destroy', $emergencyalert->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('emergencyalerts.show', [$emergencyalert->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('emergencyalerts.edit', [$emergencyalert->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>