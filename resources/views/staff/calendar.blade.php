@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow p-4">
        <h3 class="text-purple mb-4"><i class="fas fa-calendar-alt"></i> My Appointment Calendar</h3>
        <div id="calendar"></div>
    </div>
</div>

<!-- Add custom styles if needed -->
<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
    }
</style>
@endsection
