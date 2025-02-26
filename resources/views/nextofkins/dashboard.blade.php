<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Next of Kin Home - SmartCare</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

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

    .dashboard-section {
      display: none;
    }

    /* Show home section by default */
    #home {
      display: block;
    }

    .card {
      margin-top: 15px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
        <a href="#" class="sidebar-link active" onclick="showSection('home', this)"><i class="fas fa-home"></i> Home</a>
        <a href="#" class="sidebar-link" onclick="showSection('resident', this)"><i class="fas fa-user"></i> Resident</a>
        <a href="#" class="sidebar-link" onclick="showSection('appointments', this)"><i class="fas fa-calendar-check"></i> Appointments</a>
        <a href="#" class="sidebar-link" onclick="showSection('events', this)"><i class="fas fa-calendar-alt"></i> Events</a>
        <a href="#" class="sidebar-link" onclick="showSection('news', this)"><i class="fas fa-newspaper"></i> News</a>
        <a href="#" class="sidebar-link" onclick="showSection('settings', this)"><i class="fas fa-cog"></i> Settings</a>

        <!-- Logout form -->
        <form action="{{ route('nextofkin.logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
        </form>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 content">
        
        <!-- Home Section -->
        <div id="home" class="dashboard-section">
          <h1>Home</h1>
          <p>Welcome to your SmartCare dashboard! Below you'll find your resident's information, upcoming appointments and events, and the latest news.</p>
        </div>

        <!-- Resident Section -->
        <div id="resident" class="dashboard-section">
          <h1>Resident</h1>
          <p>Here you can view details about your assigned resident.</p>
          <div class="card">
            <div class="card-body">
              <h5>Resident Name: John Doe</h5>
              <p>Age: 78</p>
              <p>Room Number: 12A</p>
              <p>Contact: +123 456 789</p>
              <p>Condition: Requires daily checkups</p>
            </div>
          </div>
        </div>

        <!-- Appointments Section -->
        <div id="appointments" class="dashboard-section">
          <h1>Upcoming Appointments</h1>
          <div class="card">
            <div class="card-body">
              <p>Doctor Visit - 15th March 2025 at 10:00 AM</p>
              <p>Physical Therapy - 20th March 2025 at 2:30 PM</p>
            </div>
          </div>
        </div>

        <!-- Events Section -->
        <div id="events" class="dashboard-section">
          <h1>Upcoming Events</h1>
          <div class="card">
            <div class="card-body">
              <p>Family Day - 25th March 2025</p>
              <p>Music Therapy Session - 30th March 2025</p>
            </div>
          </div>
        </div>

        <!-- News Section -->
        <div id="news" class="dashboard-section">
          <h1>News Section</h1>
          <div class="card">
            <div class="card-body">
              <p>New staff members joining from April 2025.</p>
              <p>Upcoming facility renovations in May.</p>
            </div>
          </div>
        </div>

        <!-- Settings Section -->
        <div id="settings" class="dashboard-section">
          <h1>Settings</h1>
          <div class="card">
            <div class="card-body">
              <p>Update your contact information</p>
              <p>Change password</p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- JavaScript to handle section switching -->
  <script>
    function showSection(sectionId, element) {
      // Hide all sections
      document.querySelectorAll('.dashboard-section').forEach(section => {
        section.style.display = 'none';
      });

      // Show the selected section
      document.getElementById(sectionId).style.display = 'block';

      // Remove 'active' class from all sidebar links
      document.querySelectorAll('.sidebar-link').forEach(link => {
        link.classList.remove('active');
      });

      // Add 'active' class to the clicked sidebar link
      element.classList.add('active');
    }
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


