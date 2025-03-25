<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <!-- Bootstrap 5 Navbar (Add if needed) -->

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Side Space (for widescreen adjustment) -->
                <div class="col-lg-2"></div>

                <!-- Main Content -->
                <div class="col-lg-8"> 
                    @yield('content') 
                </div>

                <!-- Right Side Space (for widescreen adjustment) -->
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>

    <!-- ✅ Footer (Now Correctly Placed) -->
    @include('layouts.footer')

    <!-- Webpack Mix Assets -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js_scripts')
    <body>
    <!-- ✅ STAFF NAVBAR START -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
                        <a class="nav-link dropdown-toggle" href="#" id="residentDropdown" data-bs-toggle="dropdown">🏥 Residents</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('residents.index') }}">📋 View Residents</a></li>
                            <li><a class="dropdown-item" href="{{ route('careplans.index') }}">📖 Care Plans</a></li>
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
                        </ul>
                    </li>

                    <!-- Alerts, Schedule, Profile -->
                    <li class="nav-item"><a class="nav-link text-danger" href="{{ route('emergencyalerts.index') }}">🚨 Emergency Alerts</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('staff.schedule') }}">📅 My Schedule</a></li>

                    <!-- Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" data-bs-toggle="dropdown">
                            👤 {{ session('staff_name') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('staff.profile') }}">⚙️ Settings</a></li>
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

    <!-- Flash Messages, Page Content -->
    <main class="py-4">
        @yield('content')
    </main>
</body>

</body>

</html>
