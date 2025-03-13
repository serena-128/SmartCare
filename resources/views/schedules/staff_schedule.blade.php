@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center"><span>📅</span> My Schedule</h2>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">⬅ Back to Dashboard</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Shift Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Shift Type</th>
                <th>Shift Status</th>
                <th>Request Change</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->staffMember->staff_role ?? 'N/A' }}</td>
                    <td>{{ $schedule->shiftdate }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->starttime)->format('h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($schedule->endtime)->format('h:i A') }}</td>
                    <td>{{ $schedule->shifttype }}</td>
                    <td>
                        <span class="badge 
                            @if($schedule->shift_status == 'Scheduled') bg-primary
                            @elseif($schedule->shift_status == 'Pending Change') bg-warning
                            @elseif($schedule->shift_status == 'Approved') bg-success
                            @elseif($schedule->shift_status == 'Denied') bg-danger
                            @endif">
                            {{ $schedule->shift_status }}
                        </span>
                    </td>
                    <td>
                        @if($schedule->shift_status === 'Scheduled')
                             <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">Request Change</a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
