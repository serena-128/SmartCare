<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RSVP Form</title>

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

        .event-images img {
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .event-images {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .event-images .col-4 {
            padding: 5px;
        }

        .alert-success {
            margin-top: 20px;
        }

        .logo {
            display: block;
            margin: 0 auto 30px;
            max-width: 200px;
        }
        .event-images img {
    width: 100%;  /* Ensures the images fill their container */
    height: 200px; /* Fixed height for all images */
    object-fit: cover; /* Ensures the images maintain their aspect ratio while covering the assigned area */
    border-radius: 8px; /* Optional: rounds the corners of the images */
    margin-bottom: 15px;
}

    </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>RSVP for Event</h1>
      </div>

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <!-- Care Home Logo -->
        <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">


      <div class="card-body">
        <form action="{{ route('rsvp.submit') }}" method="POST">
          @csrf

          <!-- Dropdown to select event -->
          <div class="mb-3">
            <label for="event_id" class="form-label">Select Event</label>
            <select name="event_id" id="event_id" class="form-control">
    @forelse ($futureEvents as $event)
        <option value="{{ $event->id }}">
            {{ $event->title }} - {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
        </option>
    @empty
        <option value="">No upcoming events available</option>
    @endforelse
</select>

          </div>

          <button type="submit" class="btn btn-primary w-100">Submit RSVP</button>
        </form>
      </div>

      <!-- Event Photos Section -->
      <div class="event-images">
        <div class="col-4">
          <img src="{{ asset('pictures/event1.jpg') }}" alt="Care Home event 1 ">
        </div>
        <div class="col-4">
          <img src="{{ asset('pictures/carehome_event_2.jpg') }}" alt="Care Home event 2 ">
        </div>
        <div class="col-4">
            <img src="{{ asset('pictures/carehome_event_3.jpg') }}" alt="Care Home event 3 ">

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
