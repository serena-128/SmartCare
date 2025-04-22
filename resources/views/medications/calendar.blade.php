@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>📅 Medication Calendar</h2>

    {{-- ✅ Filter by Resident --}}
    <form method="GET" id="calendar-filter-form">
        <select name="resident_id" onchange="document.getElementById('calendar-filter-form').submit()" class="form-select w-auto mb-3">
            <option value="">-- Filter by Resident --</option>
            @foreach($allResidents as $res)
                <option value="{{ $res->id }}" {{ request('resident_id') == $res->id ? 'selected' : '' }}>
                    {{ $res->full_name }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- ✅ Calendar container --}}
    <div id="medication-calendar"></div>
</div>
@endsection

@push('styles')
<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
<style>
    #medication-calendar {
        max-width: 900px;
        margin: 40px auto;
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
</style>
@endpush

@push('scripts')
<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let calendarEl = document.getElementById('medication-calendar');

        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json(route('medications.calendar.events', ['resident_id' => request('resident_id')])),
            eventColor: '#378006',
        });

        calendar.render();
    });
</script>
@endpush
