@extends('layouts.app')

@section('content')
<div class="container">
    <div class="staff-profile-container">
        <h2 class="staff-profile-title">Staff Profile</h2>
        
        <div class="staff-info">
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ asset('images/default_profile.png') }}" alt="Staff Profile Picture" class="profile-pic">
                </div>
                <div class="col-md-8">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
                    <p><strong>Phone:</strong> {{ auth()->user()->phone }}</p>
                    <p><strong>Joined:</strong> {{ auth()->user()->created_at->format('d M, Y') }}</p>
                </div>
            </div>
        </div>

        <hr>

        <div class="staff-settings">
            <h4>Update Profile</h4>
            <form action="{{ route('staff.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                </div>
                
                <button type="submit" class="btn btn-primary w-100">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection
