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
<div class="mt-4">
    <span style="background-color: #28a745; color: white; padding: 4px 8px; border-radius: 4px;">Completed</span>
    <span style="background-color: #ffc107; padding: 4px 8px; border-radius: 4px;">In Progress</span>
    <span style="background-color: #dc3545; color: white; padding: 4px 8px; border-radius: 4px;">Uncompleted</span>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        },
        eventClick: function (info) {
    const taskId = info.event.id;

    Swal.fire({
        title: 'Update Task Status',
        input: 'radio',
        inputOptions: {
            'In Progress': 'In Progress',
            'Completed': 'Completed'
        },
        inputValidator: (value) => {
            if (!value) {
                return 'You need to choose a status!';
            }
        },
        showCancelButton: true,
        confirmButtonText: 'Update',
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/stafftasks/update-status/${taskId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: result.value })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Updated!', 'Task status updated.', 'success')
                        .then(() => location.reload());
                } else {
                    Swal.fire('Error', data.message || 'Something went wrong.', 'error');
                }
            });
        }
    });
},
        eventDidMount: function (info) {
    const status = info.event.extendedProps.status;

    if (status === 'Completed') {
        info.el.style.backgroundColor = '#28a745'; // green
        info.el.style.borderColor = '#28a745';
        info.el.style.color = 'white';
    } else if (status === 'In Progress') {
        info.el.style.backgroundColor = '#ffc107'; // yellow
        info.el.style.borderColor = '#ffc107';
        info.el.style.color = 'black';
    } else {
        info.el.style.backgroundColor = '#dc3545'; // red for Uncompleted
        info.el.style.borderColor = '#dc3545';
        info.el.style.color = 'white';
    }
}


    });

    calendar.render();
});
</script>
@endpush
