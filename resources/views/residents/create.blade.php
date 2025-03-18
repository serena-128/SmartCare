@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0"><i class="fas fa-user-plus"></i> Add New Resident</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('residents.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label"><i class="fas fa-user"></i> Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter full name" required>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label"><i class="fas fa-birthday-cake"></i> Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter age" required>
                        </div>

                        <div class="mb-3">
                            <label for="room_number" class="form-label"><i class="fas fa-door-closed"></i> Room Number</label>
                            <input type="text" class="form-control" id="room_number" name="room_number" placeholder="Enter room number" required>
                        </div>

                        <div class="mb-3">
                            <label for="care_level" class="form-label"><i class="fas fa-procedures"></i> Care Level</label>
                            <select class="form-select" id="care_level" name="care_level">
                                <option value="Standard">Standard</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                            </select>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Resident</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('residents.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
