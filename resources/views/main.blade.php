<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SmartCare - Care Management System</title>
    <link rel="icon" type="image/png" href="{{ asset('pictures/carehome_logo.png') }}">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #EAD8F3;
      color: #333;
      font-family: 'Poppins', sans-serif;
    }

    .header {
      text-align: center;
      padding: 30px 20px;
    }

    .header img {
      width: 180px;
    }

    .header h1 {
      font-size: 2rem;
      font-weight: 600;
    }

    .header p {
      font-size: 1rem;
      font-weight: 300;
    }

    .btn-primary, .btn-secondary {
      font-weight: 600;
      border: none;
      font-size: 16px;
      padding: 10px 20px;
      border-radius: 30px;
      margin-top: 10px;
      width: 200px;
    }

    .btn-primary {
      background-color: #6D4EA7;
    }

    .btn-primary:hover {
      background-color: #5A3D8A;
    }

    .btn-secondary {
      background-color: #FF8C00;
      color: white;
    }

    .btn-secondary:hover {
      background-color: #E07C00;
    }

    .features {
      margin-top: 40px;
      margin-bottom: 60px;
    }

    .feature-card {
      background: white;
      color: #6D4EA7;
      padding: 30px 20px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
      min-height: 220px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .feature-card h3 {
      font-size: 1.5rem;
      margin-bottom: 15px;
    }

    .feature-card p {
      font-size: 1rem;
      line-height: 1.6;
    }

    .login-section {
      margin-top: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

  <!-- Header Section -->
  <div class="header">
    <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo">
    <h1>Welcome to SmartCare</h1>
    <p>Redefining Care with Innovation</p>
  </div>

  <!-- Login Section -->
  <div class="login-section">
    <h3>Login As</h3>
    <a href="{{ route('staff.login') }}" class="btn btn-primary d-block mx-auto">Staff</a>
    <a href="{{ route('nextofkin.login') }}" class="btn btn-primary d-block mx-auto">Next of Kin</a>
  </div>

  <!-- Features Section -->
  <div class="container features">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="feature-card h-100">
          <h3>📋 Resident Care</h3>
          <p>Manage resident health, appointments, and medications efficiently.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card h-100">
          <h3>📅 Staff Scheduling</h3>
          <p>Ensure smooth staff management and shift planning.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feature-card h-100">
          <h3>🚨 Emergency Alerts</h3>
          <p>Monitor emergency situations and provide timely care.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
