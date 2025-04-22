@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📆 Upcoming Events for Residents</h2>

    <div id="calendar"></div>
</div>
@endsection
<style>
    .swal-wide {
        width: 600px !important;
    }
</style>

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js'></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');

        if (calendarEl) {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/staff/events/json',

                eventClick: function(info) {
                    const event = info.event;
                    const props = event.extendedProps;

                    Swal.fire({
                        title: `<strong>${event.title}</strong>`,
                        html: `
                            <p><b>Start:</b> ${event.start.toLocaleString()}</p>
                            <p><b>End:</b> ${event.end ? event.end.toLocaleString() : 'N/A'}</p>
                            <p><b>Description:</b> ${props.description || 'No description'}</p>
                            <p><b>RSVP Count:</b> ${props.rsvp_count || 0}</p>
                        `,
                        icon: 'info'
                    });
                },

select: function(info) {
    // Format selected date to YYYY-MM-DDTHH:MM for datetime-local input
    const selectedDate = new Date(info.startStr);
    const pad = num => String(num).padStart(2, '0');
    const formattedStart = `${selectedDate.getFullYear()}-${pad(selectedDate.getMonth()+1)}-${pad(selectedDate.getDate())}T${pad(selectedDate.getHours())}:${pad(selectedDate.getMinutes())}`;
    
    Swal.fire({
        title: 'Add New Event',
        html: `
            <div style="text-align: left;">
                <label for="swal-title" style="display:block; margin-top:10px;">Event Title</label>
                <input id="swal-title" class="swal2-input" placeholder="Enter event title">

                <label for="swal-description" style="display:block; margin-top:10px;">Description</label>
                <textarea id="swal-description" class="swal2-textarea" placeholder="Optional description" style="height:80px;"></textarea>

                <label for="swal-start" style="display:block; margin-top:15px;">Start Date & Time</label>
                <input id="swal-start" type="datetime-local" class="swal2-input" value="${formattedStart}">

                <label for="swal-end" style="display:block; margin-top:15px;">End Date & Time</label>
                <input id="swal-end" type="datetime-local" class="swal2-input">
            </div>
        `,
        customClass: {
            popup: 'swal-wide'
        },
        showCancelButton: true,
        confirmButtonText: 'Add Event',
        focusConfirm: false,
        preConfirm: () => {
            const title = document.getElementById('swal-title').value;
            const description = document.getElementById('swal-description').value;
            const start = document.getElementById('swal-start').value;
            const end = document.getElementById('swal-end').value;

            if (!title || !start || !end) {
                Swal.showValidationMessage('Please fill in Title, Start, and End date/time.');
                return false;
            }

            return { title, description, start, end };
        }
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/staff/events',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    title: result.value.title,
                    description: result.value.description,
                    start_date: result.value.start,
                    end_date: result.value.end
                },
                success: function () {
                    calendar.refetchEvents();
                    Swal.fire({
                        icon: 'success',
                        title: 'Event Added!',
                        text: 'The event was successfully created.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                },
                error: function () {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
                            });
                        }
                    });
                }
            });

            calendar.render();
        }
    });
</script>
@endpush
