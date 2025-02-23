<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Next of Kin Dashboard - SmartCare</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f3f3f3;
      margin: 0;
      padding: 0;
    }
    /* Sidebar styling */
    .sidebar {
      background-color: #fff;
      border-right: 1px solid #ddd;
      min-height: 100vh;
      padding: 20px;
    }
    .sidebar a {
      display: block;
      padding: 10px 15px;
      color: #333;
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .sidebar a:hover {
      color: #800080;
    }
    .sidebar a.active {
      font-weight: 600;
      text-decoration: underline;
      color: #800080;
    }
    /* Content area styling */
    .content {
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
        <!-- Dashboard is home so home is currently active -->
      <div class="col-md-2 sidebar">
        <a href="#" class="active">Home</a>
        <a href="#">Resident</a>
        <a href="#">Events</a>
        <a href="#">Appointments</a>
        <a href="#">News</a>
        <a href="#">Settings</a>
        <form action="{{ route('nextofkin.logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
      </div>
      <!-- Main Content -->
      <div class="col-md-10 content">
        <h1>Dashboard Home</h1>
        <p>Welcome to your SmartCare dashboard! Here you can view your resident’s information and access various features.</p>
        <!-- Additional dashboard content goes here -->
      </div>
    </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

