@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center text-purple mb-4">📅 My Appointment Calendar</h2>
        <div id="calendar"></div>
    </div>
@endsection

@push('js_scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/staff/calendar/data',  // ✅ This must match the route above
            eventDisplay: 'block',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            }
        });

        calendar.render();
    });
</script>

@endpush
