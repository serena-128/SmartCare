@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-center">📅 My Schedule</h2>
    <div id="calendar"></div>
</div>
@endsection

@section('scripts')
<script type="module">
    import { Calendar } from '@fullcalendar/core'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import interactionPlugin from '@fullcalendar/interaction'

    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar')

        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            events: "{{ route('schedules.events') }}",
            height: 'auto',
            eventColor: '#00aaff',
        })

        calendar.render()
    })
</script>
@endsection
