@extends('layouts.app')

@section('content')
<style>
#dailyTaskCalendar {
    max-width: 900px;
    margin: 0 auto;
}
</style>

<div class="container">
    <h3 class="mb-4">🗓️ My Daily Tasks</h3>
    <div id="dailyTaskCalendar"></div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('dailyTaskCalendar');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridDay',
        slotMinTime: "07:00:00",
        slotMaxTime: "20:00:00",
        allDaySlot: false,
        height: "auto",
        events: {!! $tasksJson !!},
        headerToolbar: {
            left: '',
            center: 'title',
            right: ''
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        },
        eventContent: function (info) {
            return {
                html: `
                    <div style="font-size: 0.85rem;">
                        <strong>${info.timeText}</strong><br>
                        ${info.event.title}
                    </div>`
            };
        }
    });

    calendar.render();
});
</script>
@endpush
