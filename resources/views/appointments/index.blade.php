@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Page Header with Styling -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-purple mb-0" style="color: #6a1b9a;">
            📅 Appointments
        </h2>
        <a href="{{ route('appointments.create') }}" class="btn btn-primary shadow">
            <i class="fas fa-plus-circle"></i> Add New
        </a>
    </div>

    <!-- Flash Messages -->
    @include('flash::message')

    <!-- Appointments Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @include('appointments.table')
        </div>
    </div>
</div>
@endsection
