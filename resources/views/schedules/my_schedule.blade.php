@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">📅 My Schedule</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role</th>
                <th>Shift Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Shift Type</th>
                <th>Shift Status</th>
            </tr>
        </thead>
        <tbody>
            @if($schedules->isEmpty())
                <tr>
                    <td colspan="6" class="text-center text-muted">No shifts assigned yet.</td>
                </tr>
            @else
                @foreach($schedules as $schedule)
                    <tr>
                        <td>{{ $schedule->staffMember->staff_role ?? 'N/A' }}</td>
                        <td>{{ $schedule->shiftdate }}</td>
                        <td>{{ $schedule->starttime }}</td>
                        <td>{{ $schedule->endtime }}</td>
                        <td>{{ $schedule->shifttype }}</td>
                        <td>{{ $schedule->shift_status }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection
