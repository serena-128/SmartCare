@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-purple mb-4"><i class="fas fa-birthday-cake"></i> Resident Birthdays</h2>

    <div id="calendar" class="shadow rounded p-3 bg-white"></div>
</div>
@endsection

@push('js_scripts')
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: "🎉 John Doe's Birthday",
                        start: "2025-04-02",
                        description: "Turns 82!"
                    },
                    {
                        title: "🎈 Jane Smith's Birthday",
                        start: "2025-04-10",
                        description: "Turns 76!"
                    },
                    {
                        title: "🎉 Sally Riley's Birthday",
                        start: "2025-04-18",
                        description: "Turns 90!"
                    }
                ],
                eventColor: '#ff69b4',
                eventClick: function (info) {
                    alert(info.event.title + "\n" + info.event.extendedProps.description);
                }
            });

            calendar.render();
        });
    </script>
@endpush

@push('css')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css' rel='stylesheet' />
@endpush

<style>
    #calendar {
        background-color: #fdf3f9;
        border-radius: 10px;
    }
</style>
