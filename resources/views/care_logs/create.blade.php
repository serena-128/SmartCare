@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📝 Log Care Activity for Resident {{ $resident->firstname }} {{ $resident->lastname }}</h3>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('care_logs.store', $resident->id) }}" method="POST">
        @csrf

        {{-- Activity Type Selection --}}
        <div class="form-group mb-3">
            <label for="activity_type">Activity Type</label>
            <select name="activity_type" id="activity_type" class="form-control" required>
                <option value="">Select Activity</option>
                <option value="Medication" {{ old('activity_type') == 'Medication' ? 'selected' : '' }}>Medication</option>
                <option value="Bathing" {{ old('activity_type') == 'Bathing' ? 'selected' : '' }}>Bathing</option>
                <option value="Feeding" {{ old('activity_type') == 'Feeding' ? 'selected' : '' }}>Feeding</option>
                <option value="Exercise" {{ old('activity_type') == 'Exercise' ? 'selected' : '' }}>Exercise</option>
            </select>
        </div>

        {{-- Notes (Optional) --}}
        <div class="form-group mb-3">
            <label for="notes">Notes (Optional)</label>
            <textarea name="notes" id="notes" class="form-control">{{ old('notes') }}</textarea>
        </div>

        {{-- Date Picker for Logged_at --}}
        <div class="form-group mb-3">
            <label for="logged_at">Date & Time</label>
            <input type="datetime-local" name="logged_at" id="logged_at" class="form-control"
                value="{{ old('logged_at', now()->format('Y-m-d\TH:i')) }}" required>
        </div>

        {{-- Caregiver Full Name --}}
        <div class="form-group mb-3">
            <label for="caregiver_name">Full Name</label>
            <input type="text" name="caregiver_name" id="caregiver_name" class="form-control" 
                   value="{{ old('caregiver_name') }}" required>
        </div>

        {{-- Caregiver Type Selection --}}
        <div class="form-group mb-3">
            <label for="caregiver_type">Role</label>
            <select name="caregiver_type" id="caregiver_type" class="form-control" required>
                <option value="">Select Type</option>
                <option value="Caregiver" {{ old('caregiver_type') == 'Caregiver' ? 'selected' : '' }}>Caregiver</option>
                <option value="Admin" {{ old('caregiver_type') == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Nurse" {{ old('caregiver_type') == 'Nurse' ? 'selected' : '' }}>Nurse</option>
                <option value="Other" {{ old('caregiver_type') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">✅ Submit Log</button>
        <a href="{{ route('residents.show', $resident->id) }}" class="btn btn-secondary">🔙 Cancel</a>
    </form>
</div>
@endsection
