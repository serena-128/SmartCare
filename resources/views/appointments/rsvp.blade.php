<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RSVP for Appointment</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3; /* Light gray background */
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #800080; /* Purple */
            color: #fff;
            font-size: 1.5rem;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #800080; /* Purple button */
            border: none;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #6a006a;
        }

        .alert-success {
            margin-top: 20px;
        }

        .logo {
            display: block;
            margin: 0 auto 30px;
            max-width: 200px;
        }
    </style>
</head>
<body>
    
    <!-- Back to Dashboard Button -->
    <a href="{{ url('/dashboard#') }}" class="btn btn-primary back-button m-3">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>

  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>RSVP for Appointment</h1>
      </div>

      @if(session('success'))
        <div class="alert alert-success text-center">
          {{ session('success') }}
        </div>
      @endif

      <!-- Care Home Logo -->
      <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">

      <div class="card-body">
        <form action="{{ route('appointments.rsvp.submit') }}" method="POST">
          @csrf

          <!-- Dropdown to select future appointments -->
          <div class="mb-3">
            <label for="appointment_id" class="form-label">Select Appointment</label>
            <select name="appointment_id" id="appointment_id" class="form-control" required>
                <option value="" disabled selected>Choose an appointment...</option>
                @forelse ($appointments as $appointment)
                    <option value="{{ $appointment->id }}">
                        {{ \Carbon\Carbon::parse($appointment->date)->format('l, d M Y') }} at {{ $appointment->time }} 
                        - {{ $appointment->reason }} ({{ $appointment->location }})
                    </option>
                @empty
                    <option value="">No upcoming appointments available</option>
                @endforelse
            </select>
          </div>

          <!-- RSVP Status Dropdown -->
          <div class="mb-3">
            <label class="form-label">RSVP Status</label>
            <select name="rsvp_status" class="form-control" required>
                <option value="yes">Yes</option>
                <option value="no">No</option>
                <option value="maybe">Maybe</option>
            </select>
          </div>

          <!-- Comments Section -->
          <div class="mb-3">
            <label for="comments" class="form-label">Comments (Optional)</label>
            <textarea name="comments" id="comments" rows="3" class="form-control" placeholder="Add any additional comments..."></textarea>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary w-100">Submit RSVP</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
