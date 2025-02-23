<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Signed Out - SmartCare</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #e6ccff, #f3e6ff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      margin: 0;
    }
    .message-container {
      background: #fff;
      padding: 2rem;
      border-radius: 0.75rem;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="message-container">
    <h2>You have successfully signed out of SmartCare</h2>
    <p>Thank you for using SmartCare. We hope to see you again soon.</p>
    <a href="{{ route('nextofkin.login') }}" class="btn btn-primary">Log In Again</a>
  </div>
</body>
</html>
