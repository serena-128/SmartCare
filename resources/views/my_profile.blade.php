@extends('layouts.app')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background: #f7f7ff;
    }
    .card {
        border: 0;
        border-radius: .25rem;
        box-shadow: 0 2px 6px rgba(218, 218, 253, 0.65), 0 2px 6px rgba(206, 206, 238, 0.54);
        margin-bottom: 1.5rem;
    }
</style>

<div class="container mt-4">
    <div class="main-body">
        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $staff->profile_picture) }}" 
                             alt="Profile Picture" 
                             class="rounded-circle p-1 bg-primary" 
                             width="110" height="110" style="object-fit: cover;">
                        <div class="mt-3">
                            <h4>{{ $staff->firstname }} {{ $staff->lastname }}</h4>
                            <p class="text-secondary mb-1">{{ $staff->staff_role }}</p>
                            <p class="text-muted font-size-sm">SmartCare Facility</p>
                            <a href="{{ route('my.profile.edit') }}" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @php
                            $contact = $staff->contactnumber ?? 'N/A';
                        @endphp

                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Full Name</h6></div>
                            <div class="col-sm-9 text-secondary">{{ $staff->firstname }} {{ $staff->lastname }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                            <div class="col-sm-9 text-secondary">{{ $staff->email }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Phone</h6></div>
                            <div class="col-sm-9 text-secondary">{{ $contact }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"><h6 class="mb-0">Role</h6></div>
                            <div class="col-sm-9 text-secondary">{{ $staff->staff_role }}</div>
                        </div>

                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9 text-secondary">
                                <a href="{{ route('my.profile.edit') }}" class="btn btn-primary px-4">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Optional: Extra Card -->
                {{-- 
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Other Information</h5>
                        <!-- More sections like Project Status, Address, etc. -->
                    </div>
                </div> 
                --}}
            </div>
        </div>
    </div>
</div>
@endsection
