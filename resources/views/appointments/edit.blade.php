@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-purple text-white text-center py-3">
                    <h3 class="mb-0"><i class="fas fa-edit"></i> Edit Appointment</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Resident Dropdown -->
                        <div class="mb-3">
                            <label for="residentid" class="form-label">
                                <i class="fas fa-user"></i> Select Resident
                            </label>
                            <select class="form-select" name="residentid" required>
                                <option disabled>-- Choose Resident --</option>
                                @foreach($residents as $resident)
                                    <option value="{{ $resident->id }}" {{ $appointment->residentid == $resident->id ? 'selected' : '' }}>
                                        {{ $resident->firstname }} {{ $resident->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Staff Dropdown -->
                        <div class="mb-3">
                            <label for="staffmemberid" class="form-label">
                                <i class="fas fa-user-md"></i> Assigned Staff Member
                            </label>
                            <select class="form-select" name="staffmemberid" required>
                                <option disabled>-- Choose Staff --</option>
                                @foreach($staffmembers as $staff)
                                    <option value="{{ $staff->id }}" {{ $appointment->staffmemberid == $staff->id ? 'selected' : '' }}>
                                        {{ $staff->firstname }} {{ $staff->lastname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-calendar-day"></i> Appointment Date</label>
                            <input type="date" class="form-control" name="date" value="{{ $appointment->date }}" required>
                        </div>

                        <!-- Time -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-clock"></i> Appointment Time</label>
                            <input type="time" class="form-control" name="time" value="{{ $appointment->time }}" required>
                        </div>

                        <!-- Reason -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-notes-medical"></i> Reason</label>
                            <input type="text" class="form-control" name="reason" value="{{ $appointment->reason }}" required>
                        </div>

                        <!-- Location -->
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Location</label>
                            <input type="text" class="form-control" name="location" value="{{ $appointment->location }}" required>
                        </div>

                        <!-- Save Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Update Appointment
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
