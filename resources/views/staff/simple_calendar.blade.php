@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">📅 My Appointment Calendar</h2>

    <div class="calendar">
        <div class="calendar-header">
            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
        </div>
        <div class="calendar-grid">
            @php
                $now = \Carbon\Carbon::now();
                $firstDayOfMonth = $now->copy()->startOfMonth();
                $startDay = $firstDayOfMonth->dayOfWeek;
                $daysInMonth = $now->daysInMonth;
            @endphp

            @for ($i = 0; $i < $startDay; $i++)
                <div class="empty"></div> <!-- Empty days before 1st -->
            @endfor

            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $currentDate = $now->copy()->day($day)->toDateString();
                    $dayAppointments = $appointments[$currentDate] ?? collect();
                @endphp
                <div class="day">
                    <strong>{{ $day }}</strong>
                    @foreach ($dayAppointments as $appointment)
                        <div class="appointment" onclick="showDetails('{{ $appointment->reason ?? 'Appointment' }}', '{{ $appointment->resident->firstname ?? '' }} {{ $appointment->resident->lastname ?? '' }}', '{{ $appointment->location ?? 'Unknown' }}')">
                            📌 {{ \Illuminate\Support\Str::limit($appointment->reason, 12) }}
                        </div>
                    @endforeach
                </div>
            @endfor
        </div>
    </div>
</div>
@endsection

@push('js_scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function showDetails(title, resident, location) {
    Swal.fire({
        title: title,
        html: `<strong>Resident:</strong> ${resident}<br><strong>Location:</strong> ${location}`,
        confirmButtonText: 'Close'
    });
}
</script>
@endpush

@push('styles')
<style>
.calendar {
    display: flex;
    flex-direction: column;
}
.calendar-header, .calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
}
.calendar-header div {
    font-weight: bold;
    padding: 10px 0;
}
.calendar-grid .day, .calendar-grid .empty {
    border: 1px solid #ddd;
    height: 100px;
    padding: 5px;
    overflow-y: auto;
}
.day strong {
    display: block;
    margin-bottom: 5px;
}
.appointment {
    background: #007bff;
    color: white;
    margin: 2px 0;
    padding: 2px 4px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
}
</style>
@endpush
