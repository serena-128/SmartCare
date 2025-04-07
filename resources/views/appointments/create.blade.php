@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-purple text-white text-center py-3">
                    <h3 class="mb-0"><i class="fas fa-calendar-plus"></i> Add New Appointment</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('appointments.store') }}" method="POST">
                        @csrf

                        <!-- Resident Dropdown -->
                        <div class="mb-3">
                            <label for="residentid" class="form-label">
                                <i class="fas fa-user"></i> Select Resident
                            </label>
                            <select class="form-select" id="residentid" name="residentid" required>
                                <option disabled selected>-- Choose Resident --</option>
                                @foreach($residents as $resident)
                                    <option value="{{ $resident->id }}">
                                        {{ $resident->firstname }} {{ $resident->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

<!-- Staff Member Dropdown -->
<div class="mb-3">
    <label for="staffmemberid" class="form-label">
        <i class="fas fa-user-md"></i> Select Staff Member
    </label>
    <select class="form-select" id="staffmemberid" name="staffmemberid" required>
        <option disabled selected>-- Choose Staff Member --</option>
        @foreach($staffmembers as $staff)
            <option value="{{ $staff->id }}">
                {{ $staff->firstname }} {{ $staff->lastname }}
            </option>
        @endforeach
    </select>
</div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label for="date" class="form-label"><i class="fas fa-calendar-day"></i> Appointment Date</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>

                        <!-- Time -->
                        <div class="mb-3">
                            <label for="time" class="form-label"><i class="fas fa-clock"></i> Appointment Time</label>
                            <input type="time" class="form-control" name="time" required>
                        </div>

                        <!-- Reason -->
                        <div class="mb-3">
                            <label for="reason" class="form-label"><i class="fas fa-notes-medical"></i> Reason</label>
                            <input type="text" class="form-control" name="reason" placeholder="Enter reason" required>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label for="location" class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                            <input type="text" class="form-control" name="location" placeholder="e.g. Rehab Center, Room 102" required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Appointment
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <a href="{{ route('appointments.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Appointments
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
