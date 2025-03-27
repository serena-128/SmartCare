<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Event/Appointment</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f3f3;
    }
    .container {
      max-width: 800px;
      margin-top: 50px;
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
    .btn-primary {
      background-color: #800080;
      border: none;
      border-radius: 8px;
    }
    .btn-primary:hover {
      background-color: #6a006a;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h1>Add Event / Appointment</h1>
      </div>
      <div class="card-body">
        <form action="{{ route('events.store') }}" method="POST">
          @csrf
          <!-- Title Field -->
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
          </div>
          <!-- Type Dropdown -->
          <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-control" required>
              <option value="event">Event</option>
              <option value="appointment">Appointment</option>
            </select>
          </div>
          <!-- Start Date & Time Field -->
          <div class="mb-3">
            <label for="start_date" class="form-label">Start Date & Time</label>
            <input type="datetime-local" name="start_date" id="start_date" class="form-control" required>
          </div>
          <!-- End Date & Time Field (Optional) -->
          <div class="mb-3">
            <label for="end_date" class="form-label">End Date & Time (Optional)</label>
            <input type="datetime-local" name="end_date" id="end_date" class="form-control">
          </div>
          <!-- Description Field -->
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
          </div>
          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
