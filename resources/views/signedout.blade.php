<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signed Out - SmartCare</title>
  
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
      margin: 0; /* Remove extra margin */
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh; /* Ensures it takes full height */
    }

    .signed-out-container {
      background-color: #fff;
      padding: 2rem;
      border-radius: 0.75rem;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
      text-align: center;
      width: 400px;
    }

    .logo {
      max-width: 120px;
      display: block;
      margin: 0 auto 1rem auto;
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
  </style>
</head>
<body>
  <div class="container">
    <div class="signed-out-container">
      <!-- SmartCare Logo -->
      <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
      
      <h2 class="mb-3">You Have Successfully Signed Out</h2>
      <p>Thank you for using SmartCare. We hope to see you again soon.</p>

      <a href="{{ route('nextofkin.login') }}" class="btn btn-primary w-100">Return to Login</a>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

