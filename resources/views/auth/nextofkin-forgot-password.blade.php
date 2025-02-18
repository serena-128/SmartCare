<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Forgot Password - Next-of-Kin</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-header text-center">
            <h3>Forgot Your Password?</h3>
          </div>
          <div class="card-body">
            <p class="mb-4 text-center">Enter your email address and we’ll send you a password reset link.</p>

            @if (session('status'))
              <div class="alert alert-success">
                {{ session('status') }}
              </div>
            @endif

            <form method="POST" action="{{ route('nextofkin.password.email') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required autofocus>
              </div>
              <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
