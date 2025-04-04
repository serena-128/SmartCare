
@extends('layouts.app')




    <!-- ✅ Show Success Messages -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('staff.dashboard') }}">

            <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo"> Staff Dashboard
        </a>

        <!-- Navbar Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Residents Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="residentDropdown" role="button" data-bs-toggle="dropdown">
                        🏥 Residents
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('residents.index') }}">📋 View Residents</a></li>
                        <li><a class="dropdown-item" href="{{ route('residents.create') }}">➕ Add New Resident</a></li>
                        <li><a class="dropdown-item" href="{{ route('residents.index') }}">✏️ Update Resident Info</a></li>
                        <li><a class="dropdown-item" href="{{ route('careplans.index') }}">📖 Care Plans</a></li> <!-- ✅ Added this -->
                    </ul>
                </li>

                <!-- Medical Records Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="medicalDropdown" role="button" data-bs-toggle="dropdown">
                        🩺 Residents Medical Information
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('diagnoses.index') }}">📋 View Diagnoses</a></li>
                        <li><a class="dropdown-item" href="{{ route('diagnoses.create') }}">➕ Add Diagnosis</a></li>
                        <li><a class="dropdown-item" href="{{ route('diagnoses.searchPage') }}">🔍 Search Diagnoses</a></li>
                    </ul>
                </li>

                <!-- Tasks & Appointments -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" role="button" data-bs-toggle="dropdown">
                        📅 Tasks & Appointments
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('appointments.index') }}">📅 View Appointments</a></li>
                        <li><a class="dropdown-item" href="{{ route('appointments.create') }}">➕ Schedule Appointment</a></li>
                        <li><a class="dropdown-item" href="{{ route('stafftasks.create') }}">✅ Assign Task</a></li>
                    </ul>
                </li>

                <!-- Emergency Alerts -->
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('emergencyalerts.index') }}">🚨 Emergency Alerts</a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="{{ route('staff.schedule') }}">📅 My Schedule</a>
</li>


                <!-- Profile & Logout -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        👤 {{ session('staff_name') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('staff.profile') }}">⚙️ Settings</a></li>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger" type="submit">🔓 Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

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


<!-- Auto Logout for Inactivity -->
<script>
    let timeout;
    function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            alert('Session expired due to inactivity. Logging out.');
            window.location.href = "{{ route('logout') }}";
        }, 600000); // 10 minutes
    }
    window.onload = resetTimer;
    document.onmousemove = resetTimer;
    document.onkeypress = resetTimer;
</script>

<!-- Styles -->
<style>
    .logo {
        max-width: 120px;
        margin-right: 15px;
    }
    .border-primary { border-left: 5px solid #007bff !important; }
    .border-success { border-left: 5px solid #28a745 !important; }
    .border-danger { border-left: 5px solid #dc3545 !important; }
    .border-info { border-left: 5px solid #17a2b8 !important; }
</style>

@endsection
