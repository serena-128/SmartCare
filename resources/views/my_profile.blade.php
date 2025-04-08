@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">
        <i class="fas fa-user-circle me-2 text-purple"></i> My Profile
    </h3>

    <div class="card shadow-lg rounded p-4 d-flex flex-md-row flex-column align-items-center">
        <!-- Profile Picture -->
        <div class="me-md-5 mb-3 mb-md-0 text-center">
            @if($staff->profile_picture)
                <img src="{{ asset('storage/' . $staff->profile_picture) }}" 
                     class="rounded-circle shadow" 
                     style="width: 140px; height: 140px; object-fit: cover;">
            @else
                <img src="{{ asset('images/default-profile.png') }}" 
                     class="rounded-circle shadow" 
                     style="width: 140px; height: 140px;">
            @endif
        </div>

        <!-- Staff Info -->
        <div class="flex-fill">
            <h4 class="fw-bold">{{ $staff->firstname }} {{ $staff->lastname }}</h4>
            <p class="mb-1"><strong>Email:</strong> {{ $staff->email }}</p>
            <p class="mb-1"><strong>Phone:</strong> {{ $staff->contactnumber ?? 'N/A' }}</p>
            <p class="mb-1"><strong>Role:</strong> {{ $staff->staff_role }}</p>
        </div>

        <!-- Edit Button -->
        <div class="text-center mt-3 mt-md-0">
            <a href="{{ route('my.profile.edit') }}" class="btn btn-outline-primary">
                ✏️ Edit Profile
            </a>
        </div>
    </div>
</div>

@endsection
