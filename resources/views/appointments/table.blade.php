<div class="table-responsive">
    <form method="GET" action="{{ route('appointments.index') }}" class="row g-2 mb-3">
    <div class="col-md-3">
        <input type="text" name="resident" value="{{ request('resident') }}" class="form-control" placeholder="Search by Resident">
    </div>

    <div class="col-md-3">
        <input type="text" name="staff" value="{{ request('staff') }}" class="form-control" placeholder="Search by Staff Member">
    </div>
        
    <div class="col-md-3">
        <select name="date_filter" class="form-select">
    <option value="today" {{ (request('date_filter') ?? 'today') == 'today' ? 'selected' : '' }}>Today</option>
    <option value="past" {{ request('date_filter') == 'past' ? 'selected' : '' }}>Past</option>
    <option value="future" {{ request('date_filter') == 'future' ? 'selected' : '' }}>Future</option>
    <optgroup label="Filter by Year">
        @for ($y = now()->year; $y >= 2020; $y--)
            <option value="year_{{ $y }}" {{ request('date_filter') == 'year_'.$y ? 'selected' : '' }}>
                {{ $y }}
            </option>
        @endfor
    </optgroup>
</select>

    </div>

    <div class="col-md-3 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-50"><i class="fas fa-search"></i> Search</button>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary w-50"><i class="fas fa-sync-alt"></i> Reset</a>
    </div>
</form>

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
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->resident?->firstname }} {{ $appointment->resident?->lastname }}</td>
                    <td>{{ $appointment->staffmember?->firstname }} {{ $appointment->staffmember?->lastname }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>{{ $appointment->location }}</td>
                    <td class="d-flex justify-content-center gap-2">
                        <a href="{{ route('appointments.show', $appointment->id) }}" class="btn btn-info btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $appointment->id }}" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>

                        {!! Form::open(['route' => ['appointments.destroy', $appointment->id], 'method' => 'delete', 'onsubmit' => 'return confirm("Are you sure?")']) !!}
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-muted text-center py-4">No appointments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($appointments, 'links'))
    <div class="mt-3 d-flex justify-content-center">
        {{ $appointments->appends(request()->query())->links() }}

    </div>
@endif
