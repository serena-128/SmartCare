<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact SmartCare</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <style>
    /* Apply a gradient background and use flexbox to center content vertically */
    body {
      background: linear-gradient(to right, #e6ccff, #f3e6ff);
      min-height: 100vh;
      margin: 0;
      font-family: 'Poppins', sans-serif;
      display: flex;
      flex-direction: column;
    }
    /* Center the main content area */
    .content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    /* Style the contact form container to match your register form */
    .contact-container {
      background-color: #fff;
      padding: 1.5rem;
      border-radius: 0.75rem;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
      width: 400px;
      text-align: center;
    }
    .logo {
      max-width: 120px;
      height: auto;
      display: block;
      margin: 0 auto 1rem auto;
    }
    /* Footer styling */
    footer {
      background-color: #fff;
      text-align: center;
      padding: 10px;
      border-top: 1px solid #ddd;
    }
  </style>
</head>
<body>
  <div class="content">
    <div class="contact-container">
      <img src="{{ asset('pictures/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
      <h3 class="mb-3">Contact SmartCare</h3>
      <p>We'd love to hear from you. Please fill out the form below to get in touch.</p>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form method="POST" action="{{ route('contact.submit') }}">
        @csrf
        <div class="mb-3 text-start">
          <label class="form-label">Your Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
          <label class="form-label">Email Address</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
          <label class="form-label">Message</label>
          <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Send Message</button>
      </form>
    </div>
  </div>
  
  <footer>
    <p>© {{ date('Y') }} SmartCare. All Rights Reserved.</p>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
