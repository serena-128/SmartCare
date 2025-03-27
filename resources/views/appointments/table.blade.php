<table class="table table-striped">
    <thead>
        <tr>
            <th>Resident</th>
            <th>Staff Member</th>
            <th>Date</th>
            <th>Time</th>
            <th>Reason</th>
            <th>Location</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
            <tr>
                <td>
                    {{ $appointment->resident ? $appointment->resident->firstname . ' ' . $appointment->resident->lastname : 'N/A' }}
                </td>
                <td>
                    {{ $appointment->staffmember ? $appointment->staffmember->firstname . ' ' . $appointment->staffmember->lastname : 'N/A' }}
                </td>
                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                <td>{{ $appointment->reason }}</td>
                <td>{{ $appointment->location }}</td>
                <td>
                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-sm btn-info" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-sm btn-warning" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    {!! Form::open(['route' => ['appointments.destroy', $appointment->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this appointment?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
