@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h2>✅ Done</h2>
    <p>Your request has been submitted successfully. An email will be sent to a manager to review your request</p>
    <a href="{{ route('staffDashboard') }}" class="btn btn-primary">⬅ Back to Dashboard</a>
</div>
@endsection
