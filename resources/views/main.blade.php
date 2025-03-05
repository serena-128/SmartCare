<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCare - Nursing Home Management</title>
    
    <!-- Import Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Updated Font and Styling */
        body {
            background-color: #F8F9FA; /* Soft white */
            color: #333;
            font-family: 'Poppins', sans-serif; /* Changed Font */
        }
        .header {
            text-align: center;
            padding: 50px 20px;
        }
        .header img {
            width: 250px;
        }
        .btn-primary, .btn-secondary {
            font-weight: 600;
            border: none;
            font-size: 18px;
            padding: 12px 25px;
            border-radius: 30px;
            margin-top: 10px;
            width: 200px; /* Ensures equal button width */
        }
        .btn-primary {
            background-color: #6D4EA7; /* Purple Accent */
        }
        .btn-primary:hover {
            background-color: #5A3D8A;
        }
        .btn-secondary {
            background-color: #FF8C00; /* Orange Accent */
            color: white;
        }
        .btn-secondary:hover {
            background-color: #E07C00;
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
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .login-section {
            margin-top: 30px;
            text-align: center;
        }
        h1, h3 {
            font-weight: 600;
        }
        p {
            font-weight: 300;
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

        <!-- Staff Login Button -->
        <a href="{{ route('staff.login') }}" class="btn btn-primary d-block mx-auto">Staff</a>

        <!-- Next of Kin Login Button (No Route) -->
        <a href="#" class="btn btn-secondary d-block mx-auto">Next of Kin</a>

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
