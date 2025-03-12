@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">My Schedule</h2>

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
        </tbody>
    </table>
</div>
@endsection
