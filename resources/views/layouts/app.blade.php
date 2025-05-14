<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Staff Management')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('pictures/carehome_logo.png') }}">

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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <!-- ✅ STAFF NAVBAR START -->
    <nav class="navbar navbar-expand-lg shadow-sm">
<div class="collapse navbar-collapse justify-content-between" id="navbarNav">
    <!-- LEFT: Logo & title -->
    <div class="d-flex align-items-center">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('staffDashboard') }}">
            <img src="{{ asset('images/carehome_logo.png') }}" alt="Care Home Logo" class="logo me-2">
            <span>Staff Dashboard</span>
        </a>
    </div>

    <!-- CENTER: Main Nav -->
    <ul class="navbar-nav mx-auto">
        <!-- Residents Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="residentDropdown" role="button" data-bs-toggle="dropdown">
                🏥 Residents
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('resident.hub') }}">📋 Resident Management</a></li>
                <li><a class="dropdown-item" href="{{ route('careplan.hub') }}">🩺 Care Plan Hub</a></li>
                <li><a class="dropdown-item" href="{{ route('resident.upcomingEvents') }}">📆 Upcoming Events</a></li>
                <li><a class="dropdown-item" href="{{ route('staff.photoGallery') }}">📸 Photo Gallery</a></li>
            </ul>
        </li>

        <!-- Medical Records Dropdown -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="medicalDropdown" data-bs-toggle="dropdown">🩺 Medical Information</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('diagnoses.index') }}">📋 View Diagnoses</a></li>
                <li><a class="dropdown-item" href="{{ route('medical-history.overview') }}">📜 Medical History</a></li>
                <li><a class="dropdown-item" href="{{ route('nextofkin.index') }}">🧑‍🤝‍🧑 Next of Kin Info</a></li>
                <li><a class="dropdown-item" href="{{ url('/staff/medication-search') }}">💊 Medication Center</a></li>
                <li><a class="dropdown-item" href="{{ route('dietary.index') }}">🍽️ Dietary</a></li>
            </ul>
        </li>

        <!-- Tasks -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="tasksDropdown" data-bs-toggle="dropdown">📅 Tasks & Appts</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('appointments.index') }}">📅 View Appointments</a></li>
                <li><a class="dropdown-item" href="{{ route('stafftasks.create') }}">✅ Assign Task</a></li>
                <li><a class="dropdown-item" href="{{ url('/staff/calendar') }}">📅 My Appointments</a></li>
                <li><a class="dropdown-item" href="{{ route('stafftasks.daily') }}">📌 My Daily Tasks</a></li>
            </ul>
        </li>

        <!-- Add New -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="addNewDropdown" data-bs-toggle="dropdown">➕ Add New</a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('photo.create') }}">🖼️ Add Photo</a></li>
                <li><a class="dropdown-item" href="{{ route('eventAppointment.create') }}">📆 Add Event/Appointment</a></li>
                <li><a class="dropdown-item" href="{{ route('news.create') }}">📰 Post News </a></li>
                <li><a class="dropdown-item" href="{{ route('bulletin.create') }}">📢 Create bulletin </a></li>
            </ul>
        </li>

        <!-- Alerts & Schedule -->
        <li class="nav-item"><a class="nav-link text-danger" href="{{ route('emergencyalerts.hub') }}">🚨 Alerts</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('staff.schedule') }}">📅 Schedule</a></li>
    </ul>

    <!-- RIGHT: Profile -->
    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-bs-toggle="dropdown">
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
        
        .navbar .nav-link {
  font-size: 1.1rem; /* Or try 1.2rem or 18px */
  font-weight: 500;  /* Optional: makes it bolder */
}

    </style>

    @stack('scripts')

</body>
</html>
