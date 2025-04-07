@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">📊 Resident Care Log Dashboard</h2>

    <div class="row mt-4 text-center">
        <!-- Total Residents -->
        <div class="col-md-4">
            <a href="{{ route('residents.index') }}" class="text-decoration-none">
                <div class="card text-white bg-primary mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">👥 Total Residents</h5>
                        <h3 class="display-4">{{ $totalResidents }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <!-- Today's Logged Activities -->
        <div class="col-md-4">
            <a href="{{ route('residents.index', ['date' => now()->format('Y-m-d')]) }}" class="text-decoration-none">
                <div class="card text-white bg-success mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">📝 Activities Today</h5>
                        <h3 class="display-4">{{ $todayLogsCount }}</h3>
                    </div>
                </div>
            </a>
        </div>

        <!-- Alerts -->
        <div class="col-md-4">
            <a href="{{ route('emergencyalerts.index') }}" class="text-decoration-none">
                <div class="card text-white bg-danger mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title">⚠️ Alerts</h5>
                        <h3 class="display-4">{{ $alertsCount ?? 0 }}</h3>
                        @if(($alertsCount ?? 0) == 0)
                            <small>(No Alerts Yet)</small>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Logs Table -->
    <div class="card shadow mt-4">
        <div class="card-header bg-info text-white">
            <h5>🕒 Recent Care Logs</h5>
        </div>
        <div class="card-body">
            @if($recentLogs->isNotEmpty())
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Resident</th>
                        <th>Activity Type</th>
                        <th>Logged At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentLogs as $log)
                    <tr>
                        <td>{{ $log->resident->firstname }} {{ $log->resident->lastname }}</td>
                        <td>{{ $log->activity_type }}</td>
                        <td>{{ $log->logged_at->format('d M Y, H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-muted">No recent logs found.</p>
            @endif
        </div>
    </div>
</div>
@endsection