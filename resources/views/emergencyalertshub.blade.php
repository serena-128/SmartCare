@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f2eaff;
    }
    .hub-title {
        color: #b30000;
        font-weight: bold;
    }
    .kpi-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 25px;
        margin-bottom: 30px;
        transition: transform 0.2s ease-in-out;
    }
    .kpi-card:hover {
        transform: translateY(-3px);
    }
    .hub-buttons a {
        font-size: 18px;
    }
</style>

<div class="container mt-5">
    <h2 class="text-center hub-title mb-4">🚨 Emergency Alerts Management Hub</h2>

    <!-- KPI Cards -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="kpi-card border-left-danger">
                <h6 class="text-muted">Total Alerts</h6>
                <h3 class="text-danger">{{ $totalAlerts }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kpi-card border-left-warning">
                <h6 class="text-muted">Active Alerts</h6>
                <h3 class="text-warning">{{ $activeCount }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kpi-card border-left-success">
                <h6 class="text-muted">Resolved Alerts</h6>
                <h3 class="text-success">{{ $resolvedCount }}</h3>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row text-center hub-buttons">
        <div class="col-md-4">
            <a href="{{ route('emergencyalerts.index') }}" class="btn btn-outline-primary btn-lg w-100 mb-3">📋 View All Alerts</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('emergencyalerts.create') }}" class="btn btn-outline-success btn-lg w-100 mb-3">➕ Trigger New Alert</a>
        </div>
        <div class="col-md-4">
            <a href="#" class="btn btn-outline-info btn-lg w-100 mb-3 disabled" title="Coming Soon">🔔 Live Notifications (Coming Soon)</a>
        </div>
    </div>
</div>
@endsection
