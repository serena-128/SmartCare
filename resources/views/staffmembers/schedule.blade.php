@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark text-center">📅 My Schedule</h2>

    <!-- Display the schedule data -->
    @if($scheduleData->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>Time</th>
                    <th>Task</th>
                </tr>
            </thead>
            <tbody>
                @foreach($scheduleData as $schedule)
                    <tr>
                        <td>{{ $schedule->day }}</td>
                        <td>{{ $schedule->time }}</td>
                        <td>{{ $schedule->task }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No schedule available.</p>
    @endif
</div>
@endsection
