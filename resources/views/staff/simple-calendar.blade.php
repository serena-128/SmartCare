@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">📅 My Appointment Calendar</h2>

    <div class="calendar">
        <div class="calendar-header bg-light font-weight-bold">
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
                <div class="day empty"></div>
            @endfor

            @for ($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $currentDate = $now->copy()->day($day)->toDateString();
                    $dayAppointments = $appointments[$currentDate] ?? collect();
                @endphp
                <div class="day">
                    <div class="day-number">{{ $day }}</div>
                    @foreach ($dayAppointments as $appointment)
                        <div class="appointment" onclick="showDetails(
                            '{{ $appointment->reason ?? 'Appointment' }}',
                            '{{ optional($appointment->resident)->firstname }} {{ optional($appointment->resident)->lastname }}',
                            '{{ $appointment->location ?? 'Unknown' }}'
                        )">
                            📌 {{ \Illuminate\Support\Str::limit($appointment->reason, 14) }}
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
    background: white;
    border: 1px solid #ccc;
    border-radius: 8px;
    overflow: hidden;
}
.calendar-header, .calendar-grid {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    text-align: center;
}
.calendar-header div {
    padding: 12px 0;
    font-weight: bold;
    background-color: #f0f0f0;
    border-bottom: 1px solid #ccc;
}
.calendar-grid {
    background-color: #fefefe;
}
.day {
    border: 1px solid #e0e0e0;
    height: 120px;
    padding: 6px;
    position: relative;
    overflow-y: auto;
    text-align: left;
}
.day-number {
    font-size: 14px;
    font-weight: bold;
    color: #333;
    position: absolute;
    top: 4px;
    right: 6px;
}
.appointment {
    background-color: #007bff;
    color: white;
    padding: 4px 6px;
    margin-top: 20px;
    border-radius: 4px;
    font-size: 12px;
    cursor: pointer;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.empty {
    background-color: #fafafa;
}
</style>
@endpush
