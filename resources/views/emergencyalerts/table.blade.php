<table class="table table-responsive" id="emergencyalerts-table">
    <thead>
        <th>Resident Name</th>
        <th>Triggered By</th>
        <th>Alert Type</th>
        <th>Alert Timestamp</th>
        <th>Status</th>
        <th>Resolved By</th>
        <th>Action</th>
    </thead>
    <tbody>
    @foreach($emergencyalerts as $emergencyalert)
        <tr>
            <td>{{ $emergencyalert->resident->full_name ?? 'Unknown' }}</td>
            <td>{{ $emergencyalert->triggeredBy->name ?? 'Unknown' }}</td>
            <td>{{ $emergencyalert->alerttype }}</td>
            <td>{{ $emergencyalert->alerttimestamp }}</td>
            <td>{{ $emergencyalert->status }}</td>
            <td>{{ $emergencyalert->resolvedBy->name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('emergencyalerts.show', $emergencyalert->id) }}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></a>
                <a href="{{ route('emergencyalerts.edit', $emergencyalert->id) }}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></a>
                {!! Form::open(['route' => ['emergencyalerts.destroy', $emergencyalert->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
