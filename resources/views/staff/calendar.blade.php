@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4 text-center">📅 My Appointment Calendar</h2>
    <div id="appointmentCalendar"></div>
</div>
@endsection

@push('scripts')
<!-- FullCalendar & SweetAlert2 (if not already included globally) -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('appointmentCalendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: "auto",
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        events: '/staff/appointments/json', // Route that returns JSON for staff_id
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        },
        eventClick: function (info) {
    Swal.fire({
        title: info.event.title,
        html: `<strong>Time:</strong> ${info.event.start.toLocaleString()}<br>
               <strong>Resident:</strong> ${info.event.extendedProps.resident_name || 'N/A'}<br>
               <strong>Reason:</strong> ${info.event.extendedProps.reason || 'N/A'}<br>
               <strong>Location:</strong> ${info.event.extendedProps.location || 'N/A'}`,
        confirmButtonText: 'OK'
    });
}

    });

    calendar.render();
});
</script>
@endpush
