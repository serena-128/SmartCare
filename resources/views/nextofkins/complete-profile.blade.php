<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complete Your Profile - SmartCare</title>
    
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
        .form-container {
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        .logo {
            display: block;
            margin: 0 auto 1rem;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <!-- Include your logo -->
        <img src="{{ asset('pictures/carehome_logo.png') }}" alt="SmartCare Logo" class="logo" width="150">
        <h2 class="text-center mb-4">Complete Your Profile</h2>
        
        <form action="{{ route('nextofkin.complete-profile.submit') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="contactnumber" class="form-label">Contact Number</label>
                <input type="text" name="contactnumber" id="contactnumber" class="form-control" value="{{ old('contactnumber') }}" required>
                @error('contactnumber')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
                @error('address')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="relationshiptoresident" class="form-label">Relationship to Resident</label>
                <input type="text" name="relationshiptoresident" id="relationshiptoresident" class="form-control" value="{{ old('relationshiptoresident') }}" required>
                @error('relationshiptoresident')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</body>
</html>
