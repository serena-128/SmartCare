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
    .btn-purple {
      background-color: #800080;
      color: #fff;
      border-radius: 5px;
      padding: 10px 15px;
      transition: background-color 0.3s ease;
    }
    .btn-purple:hover {
      background-color: #6a006a;
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

      <!-- Profile Picture Display -->
      <div class="my-4">
        @if($nextOfKin->profile_picture)
          <img src="{{ asset('storage/' . $nextOfKin->profile_picture) }}" alt="Profile Picture" class="profile-img">
        @else
          <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-img">
        @endif
      </div>

      <!-- Success Message -->
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <!-- Profile Form -->
      <form action="{{ route('nextofkin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3 text-start">
          <label for="firstname" class="form-label"><i class="fas fa-user"></i> First Name</label>
          <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $nextOfKin->firstname }}" required>
        </div>

        <div class="mb-3 text-start">
          <label for="lastname" class="form-label"><i class="fas fa-user"></i> Last Name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $nextOfKin->lastname }}" required>
        </div>

        <div class="mb-3 text-start">
          <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email Address</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ $nextOfKin->email }}" required>
        </div>

        <div class="mb-3 text-start">
          <label for="profile_picture" class="form-label"><i class="fas fa-camera"></i> Change Profile Picture</label>
          <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>

        <button type="submit" class="btn btn-purple w-100">
          <i class="fas fa-save"></i> Update Profile
        </button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
