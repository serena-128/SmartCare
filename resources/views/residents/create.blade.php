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
<<<<<<< HEAD
                <form action="{{ route('residents.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="firstname" class="form-label"><i class="fas fa-user"></i> First Name</label>
        <input type="text" class="form-control" name="firstname" required>
    </div>

    <div class="mb-3">
        <label for="lastname" class="form-label"><i class="fas fa-user"></i> Last Name</label>
        <input type="text" class="form-control" name="lastname" required>
    </div>

    <div class="mb-3">
        <label for="dateofbirth" class="form-label"><i class="fas fa-calendar"></i> Date of Birth</label>
        <input type="date" class="form-control" name="dateofbirth" required>
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label"><i class="fas fa-venus-mars"></i> Gender</label>
        <select class="form-select" name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="roomnumber" class="form-label"><i class="fas fa-door-closed"></i> Room Number</label>
        <input type="number" class="form-control" name="roomnumber" required>
    </div>

    <div class="mb-3">
        <label for="admissiondate" class="form-label"><i class="fas fa-calendar-plus"></i> Admission Date</label>
        <input type="date" class="form-control" name="admissiondate" required>
    </div>

    <div class="d-grid">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Resident</button>
    </div>
</form>

=======
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
>>>>>>> komal
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('residents.index') }}" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> Back to List</a>
                </div>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> komal
