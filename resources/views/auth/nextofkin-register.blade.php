<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Next of Kin Register - SmartCare</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    body {
      background: linear-gradient(to right, #e6ccff, #f3e6ff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Poppins', sans-serif;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .register-container {
      background-color: #fff;
      padding: 1.5rem;
      border-radius: 0.75rem;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
      width: 400px;
      text-align: center;

    }
      .logo {
          max-width: 120px; /* Limits width to 120px */
          height: auto; /* Maintains aspect ratio */
          display: block;
          margin: 0 auto 1rem auto; /* Centers the image */
        }


      </style>
    </head>
   <body>
  <div class="container">
    <div class="register-container">
      <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
      <h3 class="mb-3">Next of Kin Registration</h3>
      <p>Join SmartCare to stay connected with your loved one.</p>

      <form method="POST" action="{{ route('nextofkin.register.submit') }}">
        @csrf
        <div class="mb-3 text-start">
          <label for="firstname" class="form-label">First Name</label>
          <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>

        <div class="mb-3 text-start">
          <label for="lastname" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>

        <div class="mb-3 text-start">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3 text-start">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3 text-start">
          <label for="password_confirmation" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register</button>

        <div class="mt-3">
          <a href="{{ route('nextofkin.login') }}">Already have an account? Log In</a>
        </div>
      </form>
    </div>
  </div>
</body>


  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
