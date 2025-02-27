@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-dark text-center">✏️ Edit Resident Information</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('residents.update', $resident->id) }}" method="POST" onsubmit="return confirmUpdate()">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" value="{{ $resident->firstname }}" required>
        </div>

        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="{{ $resident->lastname }}" required>
        </div>

        <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" value="{{ $resident->dob }}" required>
        </div>

        <div class="mb-3">
            <label for="room_number" class="form-label">Room Number</label>
            <input type="text" name="room_number" class="form-control" value="{{ $resident->room_number }}" required>
        </div>

        <div class="mb-3">
            <label for="assigned_caregiver" class="form-label">Assigned Caregiver</label>
            <input type="text" name="assigned_caregiver" class="form-control" value="{{ $resident->assigned_caregiver }}">
        </div>

        <button type="submit" class="btn btn-success">✅ Save Changes</button>
        <a href="{{ route('residents.index') }}" class="btn btn-secondary">🏠 Cancel</a>
    </form>
</div>

<!-- Confirmation Prompt Script -->
<script>
    function confirmUpdate() {
        return confirm("Are you sure you want to update this resident’s information?");
    }
</script>
@endsection
