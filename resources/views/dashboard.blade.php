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
                    <h3>{{ $residentCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-left-success">
                <div class="card-body">
                    <h5 class="card-title text-success">Active Staff</h5>
                    <h3>{{ $staffCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-left-danger">
                <div class="card-body">
                    <h5 class="card-title text-danger">Emergency Alerts</h5>
                    <h3>{{ $emergencyAlertCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-left-info">
                <div class="card-body">
                    <h5 class="card-title text-info">Completed Tasks</h5>
                    <h3>{{ $completedTasks }}</h3>
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
            <a href="{{ route('emergencyalerts.create') }}" class="btn btn-danger btn-block">Report an Emergency</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-block">Assign a Task</a>
        </div>
    </div>

    <!-- Emergency Alerts Section -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Recent Emergency Alerts</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Resident</th>
                                <th>Alert Type</th>
                                <th>Triggered By</th>
                                <th>Status</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($recentAlerts as $alert)
                            <tr>
                                <td>{{ $alert->resident->full_name ?? 'Unknown' }}</td>
                                <td>{{ $alert->alerttype }}</td>
                                <td>{{ $alert->triggeredBy->name ?? 'Unknown' }}</td>
                                <td>{{ $alert->status }}</td>
                                <td>{{ $alert->alerttimestamp }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                    <ul class="list-group">
                        @foreach($onDutyStaff as $staff)
                            <li class="list-group-item">{{ $staff->name }} - {{ $staff->role }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
