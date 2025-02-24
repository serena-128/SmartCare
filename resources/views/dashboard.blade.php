@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-dark">SmartCare Nursing Home Dashboard</h1>
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
            <div class="card shadow-sm border-left-primary">
                <div class="card-body">
                    <h5 class="card-title text-primary">Total Residents</h5>
                    <h3>{{ $residentCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-left-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Active Staff</h5>
                    <h3>{{ $staffCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-left-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">Emergency Alerts</h5>
                    <h3>{{ $emergencyAlertCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-left-info">
                <div class="card-body">
                    <h5 class="card-title text-info">Care Plans</h5>
                    <h3>{{ $carePlanCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-4">
            <a href="{{ route('residents.create') }}" class="btn btn-primary btn-block">Add a New Resident</a>
        </div>
        <div class="col-md-4">
            <a href="/emergencyalerts" class="btn btn-danger btn-block">Report an Emergency</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('stafftasks.create') }}" class="btn btn-success btn-block">Assign a Task</a>
        </div>
    </div>

    <!-- Medical Records Access Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">Resident Medical Records</h5>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Search Bar -->
                    <form action="{{ route('residents.search') }}" method="GET" class="mb-3">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" placeholder="Search by name, room number, or medical record number..." required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </form>

                    <!-- Resident List -->
                    @if(isset($residents) && count($residents) > 0)
                        <table class="table">
                            <thead>
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
                                            <a href="{{ route('residents.medical_records', $resident->id) }}" class="btn btn-info btn-sm">
                                                View Medical Record
                                            </a>
                                        @else
                                            <button class="btn btn-secondary btn-sm" disabled>
                                                No Permission
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No residents found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Staff On-Duty Now -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Staff On-Duty Now</h5>
                </div>
                <div class="card-body">
                    @if(isset($onDutyStaff) && count($onDutyStaff) > 0)
                        <ul class="list-group">
                            @foreach($onDutyStaff as $staff)
                                <li class="list-group-item">{{ $staff->firstname }} {{ $staff->lastname }} - {{ $staff->staff_role }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">No staff currently on duty.</p>
                    @endif
                </div>
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

@endsection
