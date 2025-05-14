@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="card text-white" style="background-color: purple;">
        <div class="card-body text-center">
            <h3 class="mt-4 mb-3"><i class="fas fa-calendar-alt"></i> Appointments</h3>

        </div>
    </div>
    <div class="mt-3 mb-4 text-end">
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">
    <i class="fas fa-plus"></i> Add New
</a>

</div>

</section>

    <!-- Flash Messages -->
    @include('flash::message')

    <!-- Appointments Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @include('appointments.table')
        </div>
    </div>
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('appointments.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAppointmentModalLabel">Add New Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Resident -->
                    <div class="mb-3">
                        <label for="residentid" class="form-label">Resident</label>
                        <select name="residentid" class="form-select" required>
                        <option value="" disabled selected>Select Resident</option>
                        @foreach(App\Models\Resident::all() as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->firstname }} {{ $resident->lastname }}</option>
                        @endforeach
                    </select>

                    </div>
                    <!-- Staff -->
                    <div class="mb-3">
                        <label for="staffmemberid" class="form-label">Staff Member</label>
                        <select name="staffmemberid" class="form-select" required>
                        <option value="" disabled selected>Select Staff Member</option>
                        @foreach(App\Models\Staffmember::all() as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->firstname }} {{ $staff->lastname }}</option>
                        @endforeach
                    </select>

                    </div>
                    <!-- Date -->
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" required>
                    </div>
                    <!-- Time -->
                    <div class="mb-3">
                        <label for="time" class="form-label">Time</label>
                        <input type="time" name="time" class="form-control" required>
                    </div>
                    <!-- Reason -->
                    <div class="mb-3">
                        <label for="reason" class="form-label">Reason</label>
                        <input type="text" name="reason" class="form-control" required>
                    </div>
                    <!-- Location -->
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Appointment</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@foreach($appointments as $appointment)
<div class="modal fade" id="editModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $appointment->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">
                    <!-- Resident (disabled) -->
                    <div class="col-md-6">
                        <label class="form-label">Resident</label>
                        <input type="text" class="form-control" value="{{ $appointment->resident?->firstname }} {{ $appointment->resident?->lastname }}" disabled>
                        <input type="hidden" name="residentid" value="{{ $appointment->residentid }}">
                    </div>

                    <!-- Staff -->
                    <div class="col-md-6">
                        <label class="form-label">Staff Member</label>
                        <select name="staffmemberid" class="form-select" required>
                            <option value="" disabled>Select Staff Member</option>
                            @foreach(App\Models\Staffmember::all() as $staff)
                                <option value="{{ $staff->id }}" {{ $appointment->staffmemberid == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->firstname }} {{ $staff->lastname }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date -->
                    <div class="col-md-6">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ $appointment->date }}" required>
                    </div>

                    <!-- Time -->
                    <div class="col-md-6">
                        <label class="form-label">Time</label>
                        <input type="time" name="time" class="form-control" value="{{ $appointment->time }}" required>
                    </div>

                    <!-- Reason -->
                    <div class="col-md-12">
                        <label class="form-label">Reason</label>
                        <input type="text" name="reason" class="form-control" value="{{ $appointment->reason }}" required>
                    </div>

                    <!-- Location -->
                    <div class="col-md-12">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ $appointment->location }}" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach

<!-- ✅ Modal End -->
@endsection
