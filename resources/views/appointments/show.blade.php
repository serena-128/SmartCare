@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg">
        <!-- Header -->
        <div class="card-header bg-purple text-white text-center py-3">
            <h3 class="mb-0">
                <i class="fas fa-calendar-check"></i> Appointment Details
            </h3>
        </div>

        <!-- Appointment Info -->
        <div class="card-body px-4 py-4">
            <div class="mb-3">
                <strong><i class="fas fa-user"></i> Resident:</strong>
                {{ $appointment->resident->firstname ?? 'N/A' }} {{ $appointment->resident->lastname ?? '' }}
            </div>

            <div class="mb-3">
                <strong><i class="fas fa-user-md"></i> Staff Member:</strong>
                {{ $appointment->staffmember->firstname ?? 'N/A' }} {{ $appointment->staffmember->lastname ?? '' }}
            </div>

            <div class="mb-3">
                <strong><i class="fas fa-calendar-day"></i> Date:</strong>
                {{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}
            </div>

            <div class="mb-3">
                <strong><i class="fas fa-clock"></i> Time:</strong>
                {{ \Carbon\Carbon::parse($appointment->time)->format('H:i') }}
            </div>

            <div class="mb-3">
                <strong><i class="fas fa-notes-medical"></i> Reason:</strong>
                {{ $appointment->reason }}
            </div>

            <div class="mb-3">
                <strong><i class="fas fa-map-marker-alt"></i> Location:</strong>
                {{ $appointment->location }}
            </div>
        </div>

        <!-- Footer -->
        <div class="card-footer text-center">
            <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Back to Appointments
            </a>
        </div>
    </div>
</div>
@endsection
