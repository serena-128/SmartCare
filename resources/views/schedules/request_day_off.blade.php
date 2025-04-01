@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Request a Day Off</h2>
    
    <form action="{{ route('schedule.submitDayOffRequest', $schedule->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="request_reason">Reason for Day Off:</label>
            <textarea name="request_reason" id="request_reason" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
@endsection
