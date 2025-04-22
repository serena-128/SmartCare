<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>

<body>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<!-- ✅ Staff Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary py-1">
    <div class="container-fluid">

        <!-- Logo + Title -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('staffDashboard') }}" style="font-weight: normal;">
            <img src="{{ asset('images/carehome_logo.png') }}" alt="Care Home Logo" class="me-2" style="max-height: 40px;">
            <span style="font-size: 1.2rem;">Staff Dashboard</span>
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Nav Items -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center small">

                <!-- Residents -->
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" id="residentDropdown" role="button" data-bs-toggle="dropdown">🏥 Residents</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('resident.hub') }}">📋 Resident Management</a></li>
                        <li><a class="dropdown-item" href="{{ route('careplan.hub') }}">📝 Care Plan Hub</a></li>
                    </ul>
                </li>

                <!-- Medical -->
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" id="medicalDropdown" role="button" data-bs-toggle="dropdown">🩺 Medical Info</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('diagnoses.index') }}">📋 View Diagnoses</a></li>
                        <li><a class="dropdown-item" href="{{ route('diagnoses.searchPage') }}">🔍 Search Diagnoses</a></li>
                    </ul>
                </li>

                <!-- Tasks -->
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" role="button" data-bs-toggle="dropdown">📅 Tasks & Appointments</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('appointments.index') }}">📅 View Appointments</a></li>
                        <li><a class="dropdown-item" href="{{ route('appointments.create') }}">➕ Schedule Appointment</a></li>
                        <li><a class="dropdown-item" href="{{ route('stafftasks.index') }}">🗓️ My Daily Tasks</a></li>
                        <li><a class="dropdown-item" href="{{ url('/staff/calendar') }}">📅 My Appointments</a></li>
                    </ul>
                </li>

                <!-- Emergency Alerts -->
                <li class="nav-item px-2">
                    <a class="nav-link text-danger" href="{{ route('emergencyalerts.hub') }}">🚨 Alerts</a>
                </li>

                <!-- Schedule -->
                <li class="nav-item px-2">
                    <a class="nav-link" href="{{ route('schedules.calendar') }}">📆 My Schedule</a>
                </li>

                <!-- Management Tools -->
                @php
                    $staff = \App\Models\StaffMember::find(Session::get('staff_id'));
                @endphp
                @if($staff && in_array($staff->staff_role, ['Manager', 'HR Coordinator', 'Operations Manager']))
                    <li class="nav-item dropdown px-2">
                        <a class="nav-link dropdown-toggle text-warning" href="#" id="managementDropdown" role="button" data-bs-toggle="dropdown">⚙️ Management Tools</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if($staff->staff_role === 'Manager')
                                <li><a class="dropdown-item" href="{{ route('reports.overview') }}">📊 Reports</a></li>
                                <li><a class="dropdown-item" href="{{ route('budget.manage') }}">💰 Budget</a></li>
                            @elseif($staff->staff_role === 'HR Coordinator')
                                <li><a class="dropdown-item" href="#">👥 Staff Profiles</a></li>
                                <li><a class="dropdown-item" href="#">📝 Feedback</a></li>
                            @elseif($staff->staff_role === 'Operations Manager')
                                <li><a class="dropdown-item" href="{{ route('supplies.index') }}">📦 Supplies</a></li>
                                <li><a class="dropdown-item" href="{{ route('facility.maintenance') }}">🛠️ Maintenance</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- Profile -->
                <li class="nav-item dropdown px-2">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        👤 {{ session('staff_name') }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a href="{{ route('my.profile') }}" class="dropdown-item">👤 My Profile</a></li>
                        <li>
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
    <!-- ✅ STAFF NAVBAR END -->

    <!-- ✅ MAIN CONTENT WRAPPER -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- ✅ FOOTER -->
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

                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true // set to false if you want 24-hour format
                },

                eventContent: function(info) {
                    return {
                        html: `
                            <div style="font-size: 0.75rem; white-space: normal;">
                                <strong>${info.timeText}</strong><br>
                                ${info.event.title}
                            </div>
                        `
                    };
                },

                eventDidMount: function(info) {
                    if (info.event.extendedProps.description) {
                        new bootstrap.Tooltip(info.el, {
                            title: info.event.extendedProps.description,
                            placement: 'top',
                            trigger: 'hover',
                            container: 'body'
                        });
                    }
                },
            });

            calendar.render();
        }
    });
</script>
<script src="{{ mix('/js/app.js') }}" defer></script>





    <!-- ✅ Optional logo styling (if not in dashboard.css) -->
    <style>
        .logo {
            max-height: 50px;
            margin-right: 10px;
        }
    </style>
</body>
</html>