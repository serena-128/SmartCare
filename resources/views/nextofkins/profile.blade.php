<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Your Profile - SmartCare</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Custom Styles -->
  <style>
    body {
      background: #f3f3f3;
      font-family: 'Poppins', sans-serif;
    }
    .profile-container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      padding: 2rem;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .back-button {
      display: inline-block;
      margin-bottom: 20px;
      color: #fff;
      background-color: #800080;
      padding: 8px 15px;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }
    .back-button:hover {
      background-color: #6a006a;
    }
    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 3px solid #800080;
    }
    .profile-info p {
      font-size: 1.1rem;
      margin-bottom: 10px;
    }
    h1 {
      font-size: 2rem;
      color: #800080;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="profile-container text-center">
      <!-- Back to Dashboard Button -->
      <a href="{{ url('/dashboard#') }}" class="back-button">
        <i class="fas fa-arrow-left"></i> Back to Dashboard
      </a>
      <h1>Your Profile</h1>
      <div class="my-4">
        @if($nextOfKin->profile_picture)
          <img src="{{ asset('storage/' . $nextOfKin->profile_picture) }}" alt="Profile Picture" class="profile-img">
        @else
          <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-img">
        @endif
      </div>
      <div class="profile-info text-start">
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
