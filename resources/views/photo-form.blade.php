<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Upload Photo - SmartCare</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f3f3;
    }

    .container {
      max-width: 600px;
      margin-top: 80px;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
      background-color: #800080;
      color: white;
      font-size: 1.4rem;
      text-align: center;
      padding: 20px;
      border-radius: 15px 15px 0 0;
    }

    .btn-primary {
      background-color: #800080;
      border: none;
      border-radius: 10px;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #6a006a;
    }

    .form-control {
      border-radius: 10px;
    }

    .logo {
      display: block;
      margin: 20px auto;
      max-width: 140px;
    }

    .alert-success {
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="card">
      <div class="card-header">
        <i class="fas fa-camera"></i> Upload Photo to Gallery
      </div>

      @if(session('success'))
        <div class="alert alert-success text-center">
          {{ session('success') }}
        </div>
      @endif

      <img src="{{ asset('pictures/carehome_logo.png') }}" alt="SmartCare Logo" class="logo">

      <div class="card-body">
        <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- File Upload Only -->
          <div class="mb-4">
            <label for="photo" class="form-label">Choose a Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" required>
          </div>

          <!-- Submit -->
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-upload"></i> Upload Photo
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
