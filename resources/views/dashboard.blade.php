@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header with Logo -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <img src="{{ asset('images/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
            <h1 class="h3 text-dark ms-3">SmartCare Nursing Home Dashboard</h1>
        </div>
        <div>
            <strong>Logged in as:</strong> {{ session('staff_name') }}
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </div>

    <!-- Overview Statistics -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-lg border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Total Residents</h5>
                    <h3 class="text-dark fw-bold">{{ $residentCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-success">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Active Staff</h5>
                    <h3 class="text-dark fw-bold">{{ $staffCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-danger">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">Emergency Alerts</h5>
                    <h3 class="text-dark fw-bold">{{ $emergencyAlertCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-info">
                <div class="card-body text-center">
                    <h5 class="card-title text-info">Care Plans</h5>
                    <h3 class="text-dark fw-bold">{{ $carePlanCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="{{ route('residents.create') }}" class="btn btn-primary btn-lg w-100 rounded-pill shadow-sm">➕ Add a New Resident</a>
        </div>
        <div class="col-md-4">
            <a href="/emergencyalerts" class="btn btn-danger btn-lg w-100 rounded-pill shadow-sm">🚨 Report an Emergency</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('stafftasks.create') }}" class="btn btn-success btn-lg w-100 rounded-pill shadow-sm">✅ Assign a Task</a>
        </div>
    </div>

<!-- Resident Diagnoses Section -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-lg">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">🩺 Resident Diagnoses</h5>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <!-- Search Bar for Diagnoses -->
                <form action="{{ route('diagnoses.search') }}" method="GET" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="🔍 Search by resident name, room number, or diagnosis..." required>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>

                <!-- Diagnosis List -->
                @if(isset($diagnoses) && count($diagnoses) > 0)
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Resident Name</th>
                                <th>Room Number</th>
                                <th>Diagnosis</th>
                                <th>Vital Signs</th>
                                <th>Treatment</th>
                                <th>Test Results</th>
                                <th>Last Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($diagnoses as $diagnosis)
                            <tr>
                                <td>{{ $diagnosis->resident->firstname }} {{ $diagnosis->resident->lastname }}</td>
                                <td>{{ $diagnosis->resident->roomnumber }}</td>
                                <td>{{ $diagnosis->diagnosis }}</td>
                                <td>{{ $diagnosis->vitalsigns }}</td>
                                <td>{{ $diagnosis->treatment }}</td>
                                <td>{{ $diagnosis->testresults }}</td>
                                <td>{{ $diagnosis->updated_at->format('d M Y, H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted text-center">No diagnoses found.</p>
                @endif
            </div>
        </div>
    </div>
</div>


                    <!-- Resident List -->
                    @if(isset($residents) && count($residents) > 0)
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Resident Name</th>
                                    <th>Room Number</th>
                                    <th>Medical Record Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($residents as $resident)
                                    <tr>
                                        <td>{{ $resident->firstname }} {{ $resident->lastname }}</td>
                                        <td>{{ $resident->room_number }}</td>
                                        <td>{{ $resident->medical_record_number }}</td>
                                        <td>
                                            @if(Auth::check() && Auth::user()->can('view_medical_records'))
                                                <a href="{{ route('residents.medical_records', $resident->id) }}" class="btn btn-info btn-sm">🔎 View</a>
                                            @else
                                                <button class="btn btn-secondary btn-sm" disabled>❌ No Permission</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted text-center">No residents found.</p>
                    @endif
                </div>
 

    <!-- Staff On-Duty Now -->
    <div class="row mt-4">
        <div class="col-md-12">
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

<style>
    .logo {
        max-width: 120px;
        margin-right: 15px;
    }
    .border-primary {
        border-left: 5px solid #007bff !important;
    }
    .border-success {
        border-left: 5px solid #28a745 !important;
    }
    .border-danger {
        border-left: 5px solid #dc3545 !important;
    }
    .border-info {
        border-left: 5px solid #17a2b8 !important;
    }
</style>

@endsection
