<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet'/>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        .logo { max-height: 50px; margin-right: 10px; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('staffDashboard') }}">
            <img src="{{ asset('images/carehome_logo.png') }}" alt="Care Home Logo" class="logo"> Staff Dashboard
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Residents Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🏥 Residents</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('residents.index') }}">📋 View Residents</a></li>
                        <li><a class="dropdown-item" href="{{ route('careplans.index') }}">📖 Care Plans</a></li>
                    </ul>
                </li>

                <!-- Medical Records Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">🩺 Residents Medical Information</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('diagnoses.index') }}">📋 View Diagnoses</a></li>
                        <li><a class="dropdown-item" href="{{ route('diagnoses.searchPage') }}">🔍 Search Diagnoses</a></li>
                    </ul>
                </li>

                <!-- Tasks & Appointments -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">📅 Tasks & Appointments</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('appointments.index') }}">📅 View Appointments</a></li>
                        <li><a class="dropdown-item" href="{{ route('stafftasks.create') }}">✅ Assign Task</a></li>
                        <li><a class="dropdown-item" href="{{ url('/staff/calendar') }}">📅 My Appointments</a></li>
                    </ul>
                </li>

                <!-- Emergency Alerts -->
                <li class="nav-item">
                    <a class="nav-link text-danger" href="{{ route('emergencyalerts.index') }}">🚨 Emergency Alerts</a>
                </li>

                <!-- My Schedule -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('staff.schedule') }}">📅 My Schedule</a>
                </li>

                <!-- Resident Care Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('resident_care_dashboard') }}">📊 Resident Care Dashboard</a>
                </li>

                <!-- Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        👤 {{ session('staff_name') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('staff.profile') }}">⚙️ Settings</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">🔓 Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

@include('layouts.footer')

<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/staff/appointments/json',
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: true },
                eventContent: info => ({ html: `<div style="font-size:0.75rem;"><strong>${info.timeText}</strong><br>${info.event.title}</div>` }),
                eventDidMount: info => { if (info.event.extendedProps.description) new bootstrap.Tooltip(info.el, { title: info.event.extendedProps.description }); },
            });
            calendar.render();
        }
    });
</script>

</body>
</html>
@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">📋 Overdue Medications</h2>

        {{-- ✅ Success message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($medications->isEmpty())
            <div class="alert alert-info">
                No overdue medications found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>👤 Resident</th>
                            <th>💊 Medication</th>
                            <th>⏰ Scheduled</th>
                            <th>✅ Taken</th>
                            <th>⚙️ Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medications as $med)
                            <tr>
                                <td>{{ $med->resident->full_name ?? 'Unknown' }}</td>
                                <td>{{ $med->medication_name }}</td>
                                <td title="{{ $med->scheduled_time }}">
                                    {{ \Carbon\Carbon::parse($med->scheduled_time)->diffForHumans() }}
                                </td>
                                <td>
                                    {!! $med->taken ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}
                                </td>
                                <td>
                                    @if (!$med->taken)
                                        <form method="POST" action="{{ route('medications.markTaken', $med->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Mark as Taken
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-success">✔ Already Taken</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
