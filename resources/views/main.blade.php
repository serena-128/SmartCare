<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCare - Nursing Home Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #6D4EA7; /* Purple aesthetic */
            color: white;
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            padding: 50px 20px;
        }
        .header img {
            width: 250px;
        }
        .btn-primary {
            background-color: #FFC107;
            border: none;
        }
        .btn-primary:hover {
            background-color: #E0A800;
        }
        .features {
            margin-top: 50px;
        }
        .feature-card {
            background: white;
            color: #6D4EA7;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        .login-section {
            margin-top: 30px;
            text-align: center;
        }
        .login-section a {
            margin: 10px;
            padding: 12px 25px;
            font-size: 18px;
            border-radius: 30px;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <div class="header">
        <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo"> <!-- Ensure you upload the logo -->
        <h1>Welcome to SmartCare</h1>
        <p>Redefining Care with Innovation</p>
    </div>

    <!-- Login Section -->
    <div class="login-section">
        <h3>Login As</h3>

        <a href="{{ route('staff.login') }}" class="btn btn-primary">Staff</a>

    </div>

    <!-- Features Section -->
    <div class="container features">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-card">
                    <h3>📋 Resident Care</h3>
                    <p>Manage resident health, appointments, and medications efficiently.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h3>📅 Staff Scheduling</h3>
                    <p>Ensure smooth staff management and shift planning.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
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
