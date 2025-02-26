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
      
    /* Add vertical dividers between columns */
.home-section .col-md-4 {
  padding: 15px;
}

.home-section .col-md-4:not(:last-child) {
  border-right: 4px solid #800080; /* Thick purple divider */
}
      /* Style for the News Page */
.list-group-item {
  border-left: 4px solid #800080; /* Adds a purple left border for news items */
  margin-bottom: 10px;
  background-color: #f9f9f9;
}

.img-fluid {
  transition: transform 0.3s ease-in-out;
}

.img-fluid:hover {
  transform: scale(1.05); /* Slight zoom effect on hover */
}

.card-header i {
  margin-right: 8px;
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
        
        <!-- Home Section (Three-Column Layout) -->
        <div id="home" class="dashboard-section home-section">
  <h1>Home</h1>
  <p>Welcome to your SmartCare dashboard! Below you'll find your resident's information, upcoming appointments and events, and the latest news.</p>
  
  <div class="row">
    <!-- Column 1: Resident -->
    <div class="col-md-4">
      <h3>Resident</h3>
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

    <!-- Column 2: Upcoming Appointments & Events -->
    <div class="col-md-4">
      <h3>Upcoming Appointments & Events</h3>
      <div class="card">
        <div class="card-header">Appointments</div>
        <div class="card-body">
          <p>Doctor Visit - 15th March 2025 at 10:00 AM</p>
          <p>Physical Therapy - 20th March 2025 at 2:30 PM</p>
        </div>
      </div>
      <div class="card">
        <div class="card-header">Events</div>
        <div class="card-body">
          <p>Family Day - 25th March 2025</p>
          <p>Music Therapy Session - 30th March 2025</p>
        </div>
      </div>
    </div>

    <!-- Column 3: News Section -->
    <div class="col-md-4">
      <h3>News Section</h3>
      <div class="card">
        <div class="card-header">Photo Gallery</div>
        <div class="card-body">
          <p>Photo gallery content goes here.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-header">News Updates</div>
        <div class="card-body">
          <p>New staff members joining from April 2025.</p>
          <p>Upcoming facility renovations in May.</p>
        </div>
      </div>
      <div class="card">
        <div class="card-header">Bulletin Board</div>
        <div class="card-body">
          <p>Bulletin board content goes here.</p>
        </div>
      </div>
    </div>
  </div> <!-- End of Row -->
</div>


        <!-- Other Sections -->
        <div id="resident" class="dashboard-section" style="display: none;">
          <h1>Resident</h1>
          <p>Resident information goes here.</p>
        </div>

        <div id="appointments" class="dashboard-section" style="display: none;">
          <h1>Upcoming Appointments</h1>
          <p>Appointment details go here.</p>
        </div>

        <div id="events" class="dashboard-section" style="display: none;">
          <h1>Upcoming Events</h1>
          <p>Event details go here.</p>
        </div>

        <div id="news" class="dashboard-section" style="display: none;">
  <h1 class="mb-4">Latest News & Updates</h1>

  <div class="row">
    <!-- Column 1: News Updates -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <i class="fas fa-newspaper"></i> Latest News
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item">
              <strong>Facility Renovation Begins</strong>
              <p class="text-muted">March 15, 2025</p>
              <p>We’re upgrading our care home facilities to enhance the experience for residents.</p>
            </li>
            <li class="list-group-item">
              <strong>New Staff Members Joining</strong>
              <p class="text-muted">April 5, 2025</p>
              <p>Welcome our new nurses and caregivers to SmartCare!</p>
            </li>
            <li class="list-group-item">
              <strong>Health & Wellness Workshop</strong>
              <p class="text-muted">April 20, 2025</p>
              <p>Join us for an informative session on senior health & wellness.</p>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Column 2: Photo Gallery -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-success text-white">
          <i class="fas fa-images"></i> Photo Gallery
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4 mb-3">
              <img src="https://via.placeholder.com/150" class="img-fluid rounded shadow-sm" alt="Gallery Image">
            </div>
            <div class="col-4 mb-3">
              <img src="https://via.placeholder.com/150" class="img-fluid rounded shadow-sm" alt="Gallery Image">
            </div>
            <div class="col-4 mb-3">
              <img src="https://via.placeholder.com/150" class="img-fluid rounded shadow-sm" alt="Gallery Image">
            </div>
          </div>
          <a href="#" class="btn btn-outline-primary btn-sm">View More</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bulletin Board -->
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-warning text-dark">
          <i class="fas fa-thumbtack"></i> Bulletin Board
        </div>
        <div class="card-body">
          <p><strong>March 25, 2025:</strong> Family Day Event - Don't forget to RSVP!</p>
          <p><strong>April 10, 2025:</strong> Volunteer sign-ups are now open for the gardening club.</p>
          <p><strong>April 30, 2025:</strong> Reminder: Monthly resident check-up schedule available.</p>
        </div>
      </div>
    </div>
  </div>
</div>


        <div id="settings" class="dashboard-section" style="display: none;">
          <h1>Settings</h1>
          <p>User settings and preferences go here.</p>
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

