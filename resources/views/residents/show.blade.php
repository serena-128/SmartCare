
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">👤 Resident Profile: {{ $resident->firstname }} {{ $resident->lastname }}</h2>

    <div class="card shadow-lg p-4">
        <!-- Resident Image -->
        <div class="text-center mb-3">
            <img src="{{ asset('images/John_doe.png') }}" alt="Resident Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
        </div>

        <!-- Resident Personal Info -->
        <h4 class="text-primary">🏠 Personal Information</h4>
        <p><strong>Name:</strong> {{ $resident->firstname }} {{ $resident->lastname }}</p>
        <p><strong>Date of Birth:</strong> {{ $resident->dateofbirth }}</p>
        <p><strong>Gender:</strong> {{ $resident->gender }}</p>
        <p><strong>Room Number:</strong> {{ $resident->roomnumber }}</p>
        <p><strong>Admission Date:</strong> {{ $resident->admissiondate }}</p>

        <hr>

        <!-- Diagnoses Section -->
        <h4 class="text-danger">🩺 Diagnoses</h4>
        @if($resident->diagnoses->isNotEmpty())
            <ul>
                @foreach($resident->diagnoses as $diagnosis)
                    <li><strong>{{ $diagnosis->diagnosis }}</strong> - {{ $diagnosis->notes }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">No diagnoses recorded.</p>
        @endif
    </div>

    <div class="mt-4 text-center">
        <a href="{{ route('residents.index') }}" class="btn btn-secondary">🏠 Back to Residents List</a>
    </div>
</div>
@endsection
