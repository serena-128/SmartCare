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
    </div>
</div>
@endsection
