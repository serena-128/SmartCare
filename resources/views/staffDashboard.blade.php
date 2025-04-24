@extends('layouts.app') <!-- Extending the base layout -->

@section('content')
    <!-- ✅ Show Success Messages -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Dashboard Overview -->
    <div class="container mt-4">
        <h2 class="text-dark text-center">📊 Nursing Home Overview</h2>

        <!-- Overview Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow-lg border-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Total Residents</h5>
                        <h3 class="fw-bold">{{ $residentCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg border-success">
                    <div class="card-body text-center">
                        <h5 class="card-title text-success">Active Staff</h5>
                        <h3 class="fw-bold">{{ $staffCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg border-danger">
                    <div class="card-body text-center">
                        <h5 class="card-title text-danger">Emergency Alerts</h5>
                        <h3 class="fw-bold">{{ $emergencyAlertCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-lg border-info">
                    <div class="card-body text-center">
                        <h5 class="card-title text-info">Care Plans</h5>
                        <h3 class="fw-bold">{{ $carePlanCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Staff On-Duty -->
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">👨‍⚕️ Staff On-Duty Now</h5>
            </div>
            <div class="card-body">
                @if(isset($onDutyStaff) && count($onDutyStaff) > 0)
                    <ul class="list-group">
                        @foreach($onDutyStaff as $staff)
                            <li class="list-group-item">{{ $staff->firstname }} {{ $staff->lastname }} - <strong>{{ $staff->staff_role }}</strong></li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted text-center">No staff currently on duty.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Assigned Residents Section -->
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">🏥 Assigned Residents</h5>
            </div>
            <div class="card-body">
                @if(isset($assignedResidents) && count($assignedResidents) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Resident Name</th>
                                <th>Room Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedResidents as $resident)
                                <tr>
                                    <td>{{ $resident->firstname }} {{ $resident->lastname }}</td>
                                    <td>{{ $resident->roomnumber }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted text-center">No assigned residents.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="card shadow-lg mt-4">
        <div class="card-header text-white" style="background-color: purple;">
            <i class="fas fa-calendar-check"></i> Upcoming Appointments
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered text-center mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Resident</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($upcomingAppointments as $appt)
                        <tr>
                            <td>{{ $appt->resident->firstname }} {{ $appt->resident->lastname }}</td>
                            <td>{{ \Carbon\Carbon::parse($appt->date)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appt->time)->format('H:i') }}</td>
                            <td>{{ $appt->reason }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No upcoming appointments.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
