<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SmartCare - Forgot Password</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <!-- Custom Styles -->
  <style>
    body {
      background: linear-gradient(to right, #e6ccff, #f3e6ff); 
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }
    .forgot-password-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 0.75rem;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 0.8s forwards;
      max-width: 500px; /* Consistent with login/register */
      width: 100%;
    }
    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    .logo {
      max-width: 120px;
      display: block;
      margin: 0 auto 1rem auto;
    }
    .form-label {
      font-weight: 600;
    }
    .form-control:focus {
      border-color: #800080;
      box-shadow: 0 0 0 0.2rem rgba(128, 0, 128, 0.25);
    }
    .btn-primary {
      background-color: #800080;
      border-color: #800080;
      transition: background-color 0.3s, border-color 0.3s;
    }
    .btn-primary:hover {
      background-color: #6a008a;
      border-color: #6a008a;
    }
    .tagline {
      font-size: 1.1rem;
      color: #555;
      margin-bottom: 1rem;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="forgot-password-container text-center">
          <!-- SmartCare Logo -->
          <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
          <h3 class="mb-2">Forgot Password</h3>
          <p class="tagline">Enter your email to reset your password.</p>

          <!-- Display validation errors -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Forgot Password Form -->
          <form method="POST" action="{{ route('nextofkin.password.email') }}">
            @csrf
            <div class="mb-3 text-start">
              <label for="email" class="form-label">Email Address <i class="fas fa-envelope"></i></label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
          </form>

          <!-- Back to Login Link -->
          <div class="mt-3">
            <a href="{{ route('nextofkin.login') }}">Back to Login</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
