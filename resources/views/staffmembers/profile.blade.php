@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark text-center">👤 Staff Profile</h2>

    <div class="card shadow-lg">
        <div class="card-body">
            @if(auth()->check())  
                <h4>{{ auth()->user()->name }}</h4>
                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                <p><strong>Role:</strong> {{ auth()->user()->role ?? 'Staff' }}</p>
                <p><strong>Joined On:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>
            @else
                <p class="text-danger">You are not logged in.</p>
                <a href="{{ route('staff.login') }}" class="btn btn-primary">Login</a>
            @endif
            
            <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
