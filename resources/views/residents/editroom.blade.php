@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-dark text-center">✏️ Edit Resident Information</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('residents.update', $resident->id) }}" method="POST" onsubmit="return confirmUpdate()">
        @csrf
        @method('PUT')

        <!-- First Name -->
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" value="{{ old('firstname', $resident->firstname) }}" required>
        </div>

        <!-- Last Name -->
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="{{ old('lastname', $resident->lastname) }}" required>
        </div>

        <!-- Date of Birth -->
        <div class="mb-3">
            <label for="dateofbirth" class="form-label">Date of Birth</label>
            <input type="date" name="dateofbirth" class="form-control"
                   value="{{ old('dateofbirth', $resident->dateofbirth ? \Carbon\Carbon::parse($resident->dateofbirth)->format('Y-m-d') : '') }}" required>
        </div>

        <!-- Admission Date (FIXED) -->
        <div class="mb-3">
            <label for="admissiondate" class="form-label">Admission Date</label>
            <input type="date" name="admissiondate" class="form-control"
                   value="{{ old('admissiondate', $resident->admissiondate ? \Carbon\Carbon::parse($resident->admissiondate)->format('Y-m-d') : '') }}" required>
        </div>

        <!-- Room Number -->
        <div class="mb-3">
            <label for="roomnumber" class="form-label">Room Number</label>
            <input type="number" name="roomnumber" class="form-control" value="{{ old('roomnumber', $resident->roomnumber) }}" required>
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
