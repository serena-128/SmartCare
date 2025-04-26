@extends('layouts.app')

@section('content')
<style>
    .calendar {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        margin-top: 20px;
    }
    .calendar-header div {
        font-weight: bold;
        text-align: center;
        padding: 10px 0;
        background: #007bff;
        color: white;
    }
    .calendar-body {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }
    .day {
        background: #f9f9f9;
        min-height: 100px;
        border: 1px solid #e0e0e0;
        padding: 5px;
        position: relative;
        transition: background 0.3s;
    }
    .day:hover {
        background: #e6f7ff;
    }
    .today {
        background: #cce5ff;
    }
    .appointment {
        background: #28a745;
        color: white;
        padding: 2px 4px;
        border-radius: 4px;
        margin-top: 5px;
        font-size: 0.8em;
        display: block;
    }
    .empty {
        background: none;
        border: none;
    }
</style>

<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">📅 My Appointment Calendar</h2>

    <!-- Calendar Header -->
    <div class="calendar calendar-header">
        <div>Sun</div>
        <div>Mon</div>
        <div>Tue</div>
        <div>Wed</div>
        <div>Thu</div>
        <div>Fri</div>
        <div>Sat</div>
    </div>

    <!-- Calendar Body -->
    <div class="calendar calendar-body">
        @php
            $startOfMonth = \Carbon\Carbon::parse($currentMonth)->startOfMonth();
            $endOfMonth = \Carbon\Carbon::parse($currentMonth)->endOfMonth();
            $startDayOfWeek = $startOfMonth->dayOfWeek; // 0 (Sun) - 6 (Sat)
            $today = now()->toDateString();
        @endphp

        <!-- Empty cells before month start -->
        @for ($i = 0; $i < $startDayOfWeek; $i++)
            <div class="day empty"></div>
        @endfor

        <!-- Days of the month -->
        @for ($date = $startOfMonth; $date <= $endOfMonth; $date->addDay())
            <div class="day {{ $date->toDateString() === $today ? 'today' : '' }}">
                <strong>{{ $date->day }}</strong>

                @if(isset($appointments[$date->toDateString()]))
                    @foreach($appointments[$date->toDateString()] as $appt)
                        <span class="appointment">{{ $appt->reason }}</span>
                    @endforeach
                @endif
            </div>
        @endfor
    </div>
</div>
@endsection
