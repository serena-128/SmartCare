<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Profile - SmartCare</title>
  
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
      color: white;
      border-radius: 5px;
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
      
      <h1>Edit Profile</h1>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <div class="my-4">
        <!-- Profile Picture -->
        @if($nextOfKin->profile_picture)
          <img id="profilePreview" src="{{ asset('storage/' . $nextOfKin->profile_picture) }}" alt="Profile Picture" class="profile-img">
        @else
          <img id="profilePreview" src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-img">
        @endif
      </div>

      <!-- Profile Edit Form -->
      <form action="{{ route('nextofkin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Profile Picture Upload -->
        <div class="mb-3 text-start">
          <label for="profile_picture" class="form-label">Change Profile Picture</label>
          <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" onchange="previewImage(event)">
        </div>

        <!-- First Name -->
        <div class="mb-3 text-start">
          <label for="firstname" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname', $nextOfKin->firstname) }}">
        </div>

        <!-- Last Name -->
        <div class="mb-3 text-start">
          <label for="lastname" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname', $nextOfKin->lastname) }}">
        </div>

        <!-- Email -->
        <div class="mb-3 text-start">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $nextOfKin->email) }}" readonly>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-purple w-100">Update Profile</button>
      </form>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Preview Profile Picture Before Upload -->
  <script>
    function previewImage(event) {
      var reader = new FileReader();
      reader.onload = function() {
        var output = document.getElementById('profilePreview');
        output.src = reader.result;
      }
      reader.readAs
