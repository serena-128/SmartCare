<table class="table table-responsive" id="emergencyalerts-table">
    <thead>
        <th>Resident Name</th> <!-- Changed from Resident ID -->
        <th>Triggered By</th>
        <th>Alert Type</th>
        <th>Alert Timestamp</th>
        <th>Status</th>
        <th>Resolved By</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($emergencyalerts as $emergencyalert)
        <tr>
            <td>{!! $emergencyalert->resident->name ?? 'Unknown' !!}</td> <!-- Display Resident Name -->
            <td>{!! $emergencyalert->triggeredBy->name ?? 'Unknown' !!}</td> <!-- If available -->
            <td>{!! $emergencyalert->alerttype !!}</td>
            <td>{!! $emergencyalert->alerttimestamp !!}</td>
            <td>{!! $emergencyalert->status !!}</td>
            <td>{!! $emergencyalert->resolvedBy->name ?? 'N/A' !!}</td> <!-- If available -->
            <td>
                {!! Form::open(['route' => ['emergencyalerts.destroy', $emergencyalert->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('emergencyalerts.show', [$emergencyalert->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></a>
                    <a href="{!! route('emergencyalerts.edit', [$emergencyalert->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
