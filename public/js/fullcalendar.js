document.addEventListener('DOMContentLoaded', function () {
    var eventsCalendarEl = document.getElementById('events-calendar');

    if (eventsCalendarEl) {
        var eventsCalendar = new FullCalendar.Calendar(eventsCalendarEl, {
            initialView: 'dayGridMonth', // Default view: Month
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: '/fetch-events', // Fetch events dynamically from Laravel route
            eventClick: function (info) {
                alert('Event: ' + info.event.title + '\n' + info.event.extendedProps.description);
            }
        });

        eventsCalendar.render();
    }
});
