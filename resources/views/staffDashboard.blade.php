@extends('layouts.app')

@section('content')

<!-- ✅ Show Success Messages -->
@if(session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

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
                                <li><a class="dropdown-item" href="{{ route('staffmembers.index') }}">👥 Staff Profiles</a></li>
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

<!-- Dashboard Overview -->
<div class="container mt-4">
    <h2 class="text-dark text-center">📊 Nursing Home Overview</h2>

    <!-- Overview Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-lg border-primary">
                <div class="card-body text-center">
                    <h5 class="card-title text-primary">Total Residents</h5>
                    <h3 class="fw-bold">{{ $residentCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-success">
                <div class="card-body text-center">
                    <h5 class="card-title text-success">Active Staff</h5>
                    <h3 class="fw-bold">{{ $staffCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-danger">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger">Emergency Alerts</h5>
                    <h3 class="fw-bold">{{ $emergencyAlertCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-lg border-info">
                <div class="card-body text-center">
                    <h5 class="card-title text-info">Care Plans</h5>
                    <h3 class="fw-bold">{{ $carePlanCount ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Staff On-Duty -->
<div class="container mt-4">
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

<!-- Assigned Residents Section -->
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">🏥 Assigned Residents</h5>
        </div>
        <div class="card-body">
            @if(isset($assignedResidents) && count($assignedResidents) > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Resident Name</th>
                            <th>Room Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedResidents as $resident)
                            <tr>
                                <td>{{ $resident->firstname }} {{ $resident->lastname }}</td>
                                <td>{{ $resident->roomnumber }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted text-center">No assigned residents.</p>
            @endif
        </div>
    </div>
</div>

<!-- Upcoming Appointments -->
<div class="card shadow-lg mt-4">
    <div class="card-header text-white" style="background-color: purple;">
        <i class="fas fa-calendar-check"></i> Upcoming Appointments
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered text-center mb-0">
            <thead class="table-light">
                <tr>
                    <th>Resident</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                @forelse($upcomingAppointments as $appt)
                    <tr>
                        <td>{{ $appt->resident->firstname }} {{ $appt->resident->lastname }}</td>
                        <td>{{ \Carbon\Carbon::parse($appt->date)->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appt->time)->format('H:i') }}</td>
                        <td>{{ $appt->reason }}</td>
                    </tr>
                @empty
                    <tr><td colspan="4">No upcoming appointments.</td></tr>
                @endforelse
            </tbody>
        </table>
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

<!-- Styles -->
<style>
    .logo {
        max-width: 120px;
        margin-right: 15px;
    }
    .border-primary { border-left: 5px solid #007bff !important; }
    .border-success { border-left: 5px solid #28a745 !important; }
    .border-danger { border-left: 5px solid #dc3545 !important; }
    .border-info { border-left: 5px solid #17a2b8 !important; }
</style>
<!-- FAQ Chatbot 💬 -->
<div id="faq-chatbot">
    <div id="chat-icon" onclick="toggleChat()">
        💬
    </div>
    <div id="chat-box">
        <div id="chat-header">SmartCare Assistant</div>
        <div id="chat-body">
            <div class="chat-message bot">Hi! I’m your assistant. How can I help?</div>
        </div>
        <input type="text" id="chat-input" placeholder="Type your question..." onkeydown="handleChatKey(event)">
    </div>
</div>

<style>
    #faq-chatbot {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
    }
    #chat-icon {
        background: #6a1b9a;
        color: #fff;
        padding: 12px 14px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 20px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    #chat-box {
        display: none;
        width: 300px;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    #chat-header {
        background: #6a1b9a;
        color: #fff;
        padding: 10px;
        font-weight: bold;
        text-align: center;
    }
    #chat-body {
        max-height: 250px;
        overflow-y: auto;
        padding: 10px;
        font-size: 14px;
    }
    #chat-input {
        border: none;
        border-top: 1px solid #ddd;
        width: 100%;
        padding: 10px;
        font-size: 14px;
    }
    .chat-message {
        margin-bottom: 10px;
    }
    .chat-message.user {
        text-align: right;
        color: #333;
    }
    .chat-message.bot {
        color: #6a1b9a;
    }
</style>
<script>
    const addResidentUrl = "{{ route('residents.create') }}";
</script>


<script>
    function toggleChat() {
        const box = document.getElementById("chat-box");
        box.style.display = box.style.display === "none" ? "block" : "none";
    }

    function handleChatKey(e) {
        if (e.key === "Enter") {
            const input = document.getElementById("chat-input");
            const message = input.value.trim();
            if (!message) return;

            addMessage("user", message);
            input.value = "";

            const response = getBotReply(message.toLowerCase());
            setTimeout(() => addMessage("bot", response), 500);
        }
    }

    function addMessage(type, text) {
    const body = document.getElementById("chat-body");
    const msg = document.createElement("div");
    msg.className = `chat-message ${type}`;
    msg.innerHTML = text; // ✅ Use innerHTML to allow clickable links
    body.appendChild(msg);
    body.scrollTop = body.scrollHeight;
}


function getBotReply(question) {
    if (question.includes("visiting")) {
        return "Visiting hours are from 9am to 7pm daily.";
    }

    if (question.includes("emergency")) {
        return "In case of an emergency, go to the Emergency Alerts tab immediately.";
    }

    if (question.includes("profile")) {
        return "You can view and edit your profile under '👤 My Profile' in the top right menu.";
    }

    if (question.includes("appointment") || question.includes("schedule")) {
        return "To schedule an appointment, go to '📅 Tasks & Appointments' and click 'Schedule Appointment'.";
    }

    // ✅ Keep this BEFORE the general 'resident' check
    if (question.includes("add") && question.includes("resident")) {
        return `Doctors can add a new resident from the Residents tab. ➕ <a href="${addResidentUrl}" target="_blank">Click here to add</a>.`;
    }

    if (question.includes("resident")) {
        return "You can view resident information under '🏥 Residents' > View Residents.";
    }

    if (question.includes("care plan")) {
        return "Care plans can be found under '🏥 Residents' > Care Plans.";
    }

    if (question.includes("medication")) {
        return "Medication alerts and records can be found in the Medical Info or MAR section.";
    }

    if (question.includes("on duty") || question.includes("staff")) {
        return "The 'Staff On-Duty Now' section shows who's currently working.";
    }

    if (question.includes("tasks")) {
        return "You can assign or view tasks in the '📅 Tasks & Appointments' dropdown.";
    }

    if (question.includes("calendar")) {
        return "Your schedule and upcoming tasks are available in the '📅 My Schedule' section.";
    }

    if (question.includes("logout")) {
        return "Click on your name in the top right and select 'Logout'.";
    }

    if (question.includes("chat") || question.includes("message")) {
        return "Currently, you can use this chatbot for quick help. Messaging between staff is coming soon!";
    }

    return "I'm not sure about that. Please check the documentation or ask a supervisor.";
}



</script>


@endsection