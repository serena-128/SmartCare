@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center text-purple mb-4">📅 My Appointment Calendar</h2>
        <div id="calendar"></div>
    </div>
@endsection

@push('js_scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: '/staff/calendar/data', // ✅ this must match your route
        eventDisplay: 'block',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventDidMount: function(info) {
            // Optional tooltip
            let tooltip = new Tooltip(info.el, {
                title: info.event.extendedProps.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
        }
    });

    calendar.render();
});
</script>


@endpush
