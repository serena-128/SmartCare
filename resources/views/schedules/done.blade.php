@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>✅ Done</h2>
    <p>Your request has been submitted successfully.</p>
    <a href="{{ route('schedules.index') }}" class="btn btn-primary">Back to Schedule</a>
</div>
@endsection
