@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Medication Reminders</h1>
        <a href="{{ route('medicationReminders.create') }}" class="btn btn-primary">Add Reminder</a>
        
        @include('medication_reminders.table')
    </div>
@endsection
