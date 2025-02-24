@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Medical Record - {{ $resident->firstname }} {{ $resident->lastname }}</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-4">
        <p><strong>Date of Birth:</strong> {{ $resident->dob }}</p>
        <p><strong>Medical History:</strong> {{ $resident->medical_history }}</p>
        <p><strong>Allergies:</strong> {{ $resident->allergies }}</p>
        <p><strong>Current Medications:</strong> {{ $resident->medications }}</p>
        <p><strong>Recent Doctor’s Notes:</strong> {{ $resident->doctor_notes }}</p>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
</div>
@endsection
