@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Schedules</h2>
    <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">Add New</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Staff Member</th>
                <th>Shift Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Shift Type</th>
                <th>Requested Shift ID</th>
                <th>Shift Status</th>
                <th>Request Reason</th>
                <th>Approved By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->staff_role }}</td> <!-- Directly from schedule -->
                    <td>{{ $schedule->staffMember->firstname }} {{ $schedule->staffMember->lastname }}</td>
                    <td>{{ $schedule->shiftdate }}</td>
                    <td>{{ $schedule->starttime }}</td>
                    <td>{{ $schedule->endtime }}</td>
                    <td>{{ $schedule->shifttype }}</td>
                    <td>{{ $schedule->requested_shift_id }}</td>
                    <td>{{ $schedule->shift_status }}</td>
                    <td>{{ $schedule->request_reason }}</td>
                    <td>{{ $schedule->approver ? $schedule->approver->firstname : 'N/A' }}</td>
                    <td>
                        @if($schedule->shift_status === 'Scheduled')
                            <a href="{{ route('schedules.requestChange', $schedule->id) }}" class="btn btn-warning btn-sm">Request Change</a>
                        @elseif($schedule->shift_status === 'Pending Change')
                            <form action="{{ route('schedules.approveChange', $schedule->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>
                            <form action="{{ route('schedules.denyChange', $schedule->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Deny</button>
                            </form>
                        @else
                            <span class="text-muted">No Actions</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
