@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Add Event / Appointment</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Event/Appointment Form -->
    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Event/Appointment Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <!-- Type (Event or Appointment) -->
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" id="type" name="type" required>
                <option value="event">Event</option>
                <option value="appointment">Appointment</option>
            </select>
        </div>

        <!-- Date Selection -->
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <!-- Time Selection (Only for Appointments) -->
        <div class="mb-3">
            <label for="time" class="form-label">Time (Optional for Events)</label>
            <input type="time" class="form-control" id="time" name="time">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Add Event / Appointment</button>
    </form>
</div>
@endsection
