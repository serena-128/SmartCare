<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <!-- ✅ STAFF NAVBAR START -->
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
                        <a class="nav-link dropdown-toggle" href="#" id="residentDropdown" role="button" data-bs-toggle="dropdown">
                            🏥 Residents
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('resident.hub') }}">📋 Resident Management</a></li>
                            <li><a class="dropdown-item" href="{{ route('careplan.hub') }}">📝 Care Plan Hub</a></li> <!-- ✅ Added this -->
                        </ul>
                    </li>

                    <!-- Medical Records Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="medicalDropdown" data-bs-toggle="dropdown">🩺 Residents Medical Information</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('diagnoses.index') }}">📋 View Diagnoses</a></li>
                            <li><a class="dropdown-item" href="{{ route('diagnoses.searchPage') }}">🔍 Search Diagnoses</a></li>
                        </ul>
                    </li>

                    <!-- Tasks -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" data-bs-toggle="dropdown">📅 Tasks & Appointments</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('appointments.index') }}">📅 View Appointments</a></li>
                            <li><a class="dropdown-item" href="{{ route('stafftasks.create') }}">✅ Assign Task</a></li>
                            <li><a class="dropdown-item" href="{{ url('/staff/calendar') }}">📅 Show my appointments</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('photo.create') }}">🖼️ Add Photos</a></li>
                            <li><a class="dropdown-item" href="{{ route('eventAppointment.create') }}">➕ Add Event/Appointment</a></li>
                        </ul>
                    </li>

                    <!-- Alerts, Schedule, Profile -->
                    <li class="nav-item"><a class="nav-link text-danger" href="{{ route('emergencyalerts.hub') }}">🚨 Emergency Alerts</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('staff.schedule') }}">📅 My Schedule</a></li>

                    <!-- Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-bs-toggle="dropdown">
                            👤 {{ session('staff_name') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <a href="{{ route('my.profile') }}" class="nav-link">👤 My Profile</a>
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

    <!-- ✅ Optional logo styling (if not in dashboard.css) -->
    <style>
        .logo {
            max-height: 50px;
            margin-right: 10px;
        }
    </style>

    @stack('scripts')

</body>
</html>
