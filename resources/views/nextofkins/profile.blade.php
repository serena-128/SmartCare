<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Back to Dashboard Button -->
    <a href="{{ url('/dashboard#') }}" class="btn btn-primary back-button">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
    </a>
  <title>Your Profile - SmartCare</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Your Profile</h1>

    <div class="text-center mb-4">
      @if($nextOfKin->profile_picture)
        <img src="{{ asset('storage/' . $nextOfKin->profile_picture) }}" 
             alt="Profile Picture" 
             class="img-thumbnail rounded-circle" 
             style="width: 150px; height: 150px; object-fit: cover;">
      @else
        <img src="{{ asset('images/default-profile.png') }}" 
             alt="Default Profile Picture" 
             class="img-thumbnail rounded-circle" 
             style="width: 150px; height: 150px; object-fit: cover;">
      @endif
    </div>

    <div class="card">
      <div class="card-body">
        <p><strong>First Name:</strong> {{ $nextOfKin->firstname }}</p>
        <p><strong>Last Name:</strong> {{ $nextOfKin->lastname }}</p>
        <p><strong>Email:</strong> {{ $nextOfKin->email }}</p>
        <!-- Add any other profile details you'd like to show -->
      </div>
    </div>

    
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
