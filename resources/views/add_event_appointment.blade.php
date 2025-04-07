<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Event - SmartCare</title>

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
            padding-top: 50px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
        }

        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.75rem;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            width: 90%;
            text-align: center;
        }

        .logo {
            max-width: 150px;
            height: auto;
            display: block;
            margin: 0 auto 1rem auto;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 95%;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
            <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
            <h3 class="mb-3">Add Event / Appointment</h3>
            <p>Schedule an event or appointment for SmartCare residents.</p>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Form -->
            <form action="{{ route('events.store') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="mb-3 text-start">
                    <label for="title" class="form-label">Event/Appointment Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <!-- Type Selection -->
                <div class="mb-3 text-start">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="event">Event</option>
                        <option value="appointment">Appointment</option>
                    </select>
                </div>

                <!-- Date Selection -->
                <div class="mb-3 text-start">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <!-- Time Selection -->
                <div class="mb-3 text-start">
                    <label for="time" class="form-label">Time (Optional)</label>
                    <input type="time" class="form-control" id="time" name="time">
                </div>

                <!-- Description -->
                <div class="mb-3 text-start">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Add Event / Appointment</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
