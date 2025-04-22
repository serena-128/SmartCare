@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">📅 My Daily Tasks</h2>
    <div id="calendar"></div>
</div>
@endsection

@section('scripts')
<script type="module">
    import { Calendar } from '@fullcalendar/core';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import interactionPlugin from '@fullcalendar/interaction';

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridDay', // Shows today’s tasks
            events: "{{ route('tasks.json') }}", // JSON endpoint for staff's tasks
            height: 'auto',
            eventColor: '#17a2b8', // Light blue color for tasks
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridDay,dayGridWeek,dayGridMonth'
            }
        });

        calendar.render();
    });
</script>
@endsection
