@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h2 class="mb-0">👤 Staff Profile</h2>
                </div>
                <div class="card-body text-center">
                    @if(auth()->check())  
                        <div class="mb-3">
                            <img src="https://via.placeholder.com/120" alt="Profile Picture" class="rounded-circle shadow">
                        </div>
                        <h4 class="text-dark">{{ auth()->user()->name }}</h4>
                        <p class="text-muted"><i class="fas fa-envelope"></i> <strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p class="text-muted"><i class="fas fa-user-tag"></i> <strong>Role:</strong> {{ auth()->user()->role ?? 'Staff' }}</p>
                        <p class="text-muted"><i class="fas fa-calendar-alt"></i> <strong>Joined On:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>

                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary mt-3"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
                    @else
                        <p class="text-danger">You are not logged in.</p>
                        <a href="{{ route('staff.login') }}" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
