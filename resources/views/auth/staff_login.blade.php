<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartCare - Staff Login</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            background-color: #EAD8F3; /* Matches Next of Kin login */
            color: #333;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Card Styling */
        .login-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        /* Logo */
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }

        /* Form Inputs */
        .form-control {
            border-radius: 8px;
            padding: 12px;
        }

        /* Buttons */
        .btn-primary {
            background-color: #6D4EA7;
            font-weight: 600;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #5A3D8A;
        }

        /* Links */
        .login-links {
            margin-top: 10px;
            font-size: 14px;
        }

        .login-links a {
            text-decoration: none;
            color: #6D4EA7;
            font-weight: 600;
        }

        .login-links a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                max-width: 90%;
            }
        }
    </style>
</head>
<body>

    <!-- Login Card -->
    <div class="login-card">
        <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo" class="logo">

        <h2>Staff Login</h2>
        <p>Welcome to SmartCare – Redefining Care With Innovation</p>

        <!-- Login Form -->
        <form method="POST" action="{{ route('staff.login') }}">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-primary">Log In</button>
        </form>

        <!-- Forgot Password & Register Links -->
        <div class="login-links">
            <a href="#">Forgot Password?</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>