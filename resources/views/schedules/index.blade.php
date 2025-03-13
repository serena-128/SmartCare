@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Schedules</h2>
    
  

    <!-- ✅ Add a Bootstrap-styled table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
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
                        <td>{{ $schedule->staffMember->staff_role }}</td> 
                        <td>{{ $schedule->staffMember->firstname }} {{ $schedule->staffMember->lastname }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->shiftdate)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->starttime)->format('h:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($schedule->endtime)->format('h:i A') }}</td>
                        <td>{{ ucfirst($schedule->shifttype) }}</td>
                        <td>{{ $schedule->requested_shift_id ?? 'N/A' }}</td>
                        <td><span class="badge bg-info text-dark">{{ $schedule->shift_status }}</span></td>
                        <td>{{ $schedule->request_reason ?? 'N/A' }}</td>
                        <td>{{ $schedule->approver ? $schedule->approver->firstname : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">
                                Request Change
                            </a>
                            <td>
    @if($schedule->leave_requested === 'No')
        <form action="{{ route('schedule.requestDayOff', $schedule->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">Request Day Off</button>
        </form>
    @else
        <button class="btn btn-secondary" disabled>Requested</button>
    @endif
</td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
