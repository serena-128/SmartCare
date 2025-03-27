<table class="table table-bordered table-hover text-center align-middle shadow-sm" style="background-color: #fff;">
    <thead class="table-light text-purple fw-bold">
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
                <td>{{ $appointment->resident?->firstname }} {{ $appointment->resident?->lastname }}</td>
                <td>{{ $appointment->staffmember?->firstname }} {{ $appointment->staffmember?->lastname }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                <td>{{ $appointment->reason }}</td>
                <td>{{ $appointment->location }}</td>
                <td class="d-flex justify-content-center gap-2">
                    <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    {!! Form::open(['route' => ['appointments.destroy', $appointment->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
