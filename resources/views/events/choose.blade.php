@extends('layouts.app')

@section('title', 'Add Event / Appointment')

@section('content')
<style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f3f3;
    }
    .container {
      max-width: 800px;
      margin-top: 0px;
    }
    .card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .card-header {
      background-color: #800080;
      color: #fff;
      font-size: 1.5rem;
      text-align: center;
      padding: 20px;
      border-radius: 10px 10px 0 0;
    }
    .form-control {
      border-radius: 8px;
    }
    .btn-success {
      background-color: #28a745;
      border: none;
      border-radius: 8px;
    }
    .btn-success:hover {
      background-color: #218838;
    }
</style>

<div class="container">
  <div class="card">
    <div class="card-header">
      <h3>Add Event / Appointment</h3>
    </div>
    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success mt-3">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('eventAppointment.store') }}" method="POST">
        @csrf

        <!-- Type Dropdown -->
        <div class="mb-3">
          <label for="type" class="form-label">Select Type</label>
          <select name="type" id="type" class="form-control" required>
            <option value="">-- Select --</option>
            <option value="event">Event</option>
            <option value="appointment">Appointment</option>
          </select>
        </div>

        <!-- Event Fields -->
        <div id="event-fields" style="display: none;">
          <div class="mb-3">
            <label for="event_title" class="form-label">Event Title</label>
            <input type="text" name="event_title" id="event_title" class="form-control">
          </div>
          <div class="mb-3">
            <label for="event_description" class="form-label">Description</label>
            <textarea name="event_description" id="event_description" rows="3" class="form-control"></textarea>
          </div>
          <div class="mb-3">
            <label for="event_start_date" class="form-label">Start Date &amp; Time</label>
            <input type="datetime-local" name="event_start_date" id="event_start_date" class="form-control">
          </div>
          <div class="mb-3">
            <label for="event_end_date" class="form-label">End Date &amp; Time</label>
            <input type="datetime-local" name="event_end_date" id="event_end_date" class="form-control">
          </div>
        </div>

        <!-- Appointment Fields -->
        <div id="appointment-fields" style="display: none;">
          <div class="mb-3">
            <label for="resident_id" class="form-label">Select Resident</label>
            <select name="resident_id" id="resident_id" class="form-control">
              <option value="">-- Select Resident --</option>
              @foreach($residents as $resident)
                <option value="{{ $resident->id }}">
                  {{ $resident->firstname }} {{ $resident->lastname }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="staffmember_id" class="form-label">Select Staff Member</label>
            <select name="staffmember_id" id="staffmember_id" class="form-control">
              <option value="">-- Select Staff Member --</option>
              @foreach($staffmembers as $staff)
                <option value="{{ $staff->id }}">
                  {{ $staff->firstname }} {{ $staff->lastname }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="appointment_date" class="form-label">Date</label>
            <input type="date" name="appointment_date" id="appointment_date" class="form-control">
          </div>
          <div class="mb-3">
            <label for="appointment_time" class="form-label">Time</label>
            <input type="time" name="appointment_time" id="appointment_time" class="form-control">
          </div>
          <div class="mb-3">
            <label for="appointment_reason" class="form-label">Reason</label>
            <input type="text" name="appointment_reason" id="appointment_reason" class="form-control">
          </div>
          <div class="mb-3">
            <label for="appointment_location" class="form-label">Location</label>
            <input type="text" name="appointment_location" id="appointment_location" class="form-control">
          </div>
        </div>

        <button type="submit" class="btn btn-success w-100">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const eventFields = document.getElementById('event-fields');
    const appointmentFields = document.getElementById('appointment-fields');

    typeSelect.addEventListener('change', function () {
      const value = this.value;
      eventFields.style.display = value === 'event' ? 'block' : 'none';
      appointmentFields.style.display = value === 'appointment' ? 'block' : 'none';
    });
  });
</script>
@endpush
