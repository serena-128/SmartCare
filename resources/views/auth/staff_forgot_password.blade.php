<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Staff</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #EAD8F3;
            color: #333;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .forgot-password-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 8px;
            padding: 12px;
        }
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
    </style>
</head>
<body>

    <div class="forgot-password-card">
        <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo" class="logo">
        <h2>Forgot Password</h2>
        <p>Enter your email to receive a password reset link.</p>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('staff.password.email') }}">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <button type="submit" class="btn btn-primary">Send Reset Link</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
