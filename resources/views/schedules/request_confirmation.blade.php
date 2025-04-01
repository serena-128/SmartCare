@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <div class="alert alert-success">
        <h2>✅ Request Submitted!</h2>
        <p>Your shift change request has been sent successfully. A manager will review it and reply soon.</p>
        <a href="{{ route('schedules.index') }}" class="btn btn-primary">Back to Schedule</a>
    </div>
</div>
@endsection
