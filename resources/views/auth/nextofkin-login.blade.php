<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Care Home - Next of Kin Login</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Set a gradient background for a warm, welcoming feel */
    body {
      background: linear-gradient(to right, #6a11cb, #2575fc);
      min-height: 100vh;
      display: flex;
      align-items: center;
    }
    /* Centered login container with a soft shadow and rounded corners */
    .login-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 0.5rem;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    /* Style for the care home logo */
    .logo {
      max-width: 150px;
      display: block;
      margin: 0 auto 1rem auto;
    }
    /* Optional: Bold labels for better readability */
    .form-label {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-4">
        <div class="login-container text-center">
          <!-- Care Home Logo -->
          <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
          <h3 class="mb-4">Next of Kin Login</h3>

          <!-- Display any validation errors -->
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0 list-unstyled">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <!-- Login Form -->
          <form method="POST" action="{{ route('nextofkin.login.submit') }}">
            @csrf
            <div class="mb-3 text-start">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required autofocus>
            </div>
            <div class="mb-3 text-start">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="form-check text-start mb-3">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100">Log In</button>
          </form>

          <!-- Optional link for password reset -->
          <div class="mt-3">
            <a href="{{ route('nextofkin.forgot') }}">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

