@extends('layouts.app')

@section('content')
<div class="container">
    <div class="resident-form-container">
        <h2 class="resident-form-title">Add New Resident</h2>
        
        <form action="{{ route('residents.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>

            <div class="mb-3">
                <label for="room_number" class="form-label">Room Number</label>
                <input type="text" class="form-control" id="room_number" name="room_number" required>
            </div>

            <div class="mb-3">
                <label for="care_level" class="form-label">Care Level</label>
                <select class="form-control" id="care_level" name="care_level">
                    <option value="Standard">Standard</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Save Resident</button>
        </form>
    </div>
</div>
@endsection
