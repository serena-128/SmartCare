@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">📆 Upcoming Events for Residents</h2>

    <div id="calendar"></div>
</div>
@endsection

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
                    Swal.fire({
                        title: 'Add New Event',
                        html: `
                            <input id="swal-title" class="swal2-input" placeholder="Event Title">
                            <textarea id="swal-description" class="swal2-textarea" placeholder="Description"></textarea>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Add',
                        preConfirm: () => {
                            const title = document.getElementById('swal-title').value;
                            const description = document.getElementById('swal-description').value;
                            if (!title) {
                                Swal.showValidationMessage('Event title is required');
                            }
                            return { title, description };
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
                                    start_date: info.startStr,
                                    end_date: info.endStr
                                },
                                success: function () {
                                    Swal.fire('Success!', 'Event added.', 'success');
                                    calendar.refetchEvents();
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
