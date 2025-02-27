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


    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

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

#calendar {
  max-width: 100%;
  margin: auto;
  padding: 20px;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
  <h1>Resident Overview</h1>

  <div class="row">
    <!-- Column 1: Resident Information -->
    <div class="col-md-6">
      <h3>Resident Information</h3>
      <div class="card">
        <div class="card-body">
          <h5>Full Name: {{ $resident->firstname ?? 'N/A' }} {{ $resident->lastname ?? '' }}</h5>
          <p><strong>Room Number:</strong> {{ $resident->room_number ?? 'N/A' }}</p>
          <p><strong>Current Care Level:</strong> {{ $resident->care_level ?? 'N/A' }}</p>
          <p><strong>Current Status:</strong> {{ $resident->status ?? 'N/A' }}</p>
          <p><strong>Assigned Caregiver:</strong> {{ $resident->caregiver_name ?? 'N/A' }}</p>
          <p><strong>Care Plan Status:</strong> {{ $resident->care_plan_status ?? 'N/A' }}</p>
        </div>
      </div>
    </div>

    <!-- Column 2: Health Overview & Emergency Contact -->
    <div class="col-md-6">
      <h3>General Health Overview & Emergency Contact</h3>
      <div class="card">
        <div class="card-body">
          <p><strong>Recent Checkups:</strong> {{ $resident->recent_checkups ?? 'No checkups available' }}</p>
          <p><strong>Medications:</strong> {{ $resident->medications ?? 'N/A' }}</p>
          <p><strong>Health Notes:</strong> {{ $resident->health_notes ?? 'N/A' }}</p>
          <hr>
          <p><strong>Emergency Contact Name:</strong> {{ $resident->emergency_contact_name ?? 'N/A' }}</p>
          <p><strong>Emergency Contact Number:</strong> {{ $resident->emergency_contact_phone ?? 'N/A' }}</p>
        </div>
      </div>
    </div>
  </div>
</div>


        <div id="appointments" class="dashboard-section" style="display: none;">
          <h1>Upcoming Appointments</h1>
          <p>View and manage upcoming appointments.</p>

          <!-- Calendar Container -->
          <div id="calendar"></div>
        </div>

        <div id="events" class="dashboard-section" style="display: none;">
          <h1>Upcoming Events</h1>
          <p>View upcoming activities and social events at the care home.</p>

          <!-- Calendar Container -->
          <div id="events-calendar"></div>
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
  <h1>Account Settings</h1>
  <p>Manage your personal information and notification preferences.</p>

  <div class="row">
    <!-- Column 1: Profile Settings -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <i class="fas fa-user-cog"></i> Profile Settings
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('nextofkin.settings.update') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::guard('nextofkin')->user()->firstname ?? '') }}">
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::guard('nextofkin')->user()->email ?? '') }}">
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', Auth::guard('nextofkin')->user()->contactnumber ?? '') }}">
            </div>

            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Column 2: Notification Preferences -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-warning text-dark">
          <i class="fas fa-bell"></i> Notification Preferences
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('nextofkin.notifications.update') }}">
            @csrf
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications">
              <label class="form-check-label" for="email_notifications">Receive email notifications</label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="sms_notifications" name="sms_notifications">
              <label class="form-check-label" for="sms_notifications">Receive SMS alerts</label>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="carehome_updates" name="carehome_updates">
              <label class="form-check-label" for="carehome_updates">Receive care home updates</label>
            </div>

            <button type="submit" class="btn btn-warning w-100 mt-3">Update Preferences</button>
          </form>
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
          
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth', // Default view: Month
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay' // Different views
      },
      events: [
        {
          title: 'Doctor Visit',
          start: '2025-03-15T10:00:00',
          description: 'Annual checkup with Dr. Smith.'
        },
        {
          title: 'Physical Therapy',
          start: '2025-03-20T14:30:00',
          description: 'Therapy session for mobility exercises.'
        }
      ],
      eventClick: function(info) {
        alert('Appointment: ' + info.event.title + '\n' + info.event.extendedProps.description);
      }
    });

    calendar.render();
  });
</script>

          <script>
  document.addEventListener('DOMContentLoaded', function() {
    var eventsCalendarEl = document.getElementById('events-calendar');
    var eventsCalendar = new FullCalendar.Calendar(eventsCalendarEl, {
      initialView: 'dayGridMonth', // Default view: Month
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay' // Different views
      },
      events: [
        {
          title: 'Family Day',
          start: '2025-03-25',
          description: 'Families are invited to spend time with residents.'
        },
        {
          title: 'Music Therapy',
          start: '2025-03-30',
          description: 'Live music session to help improve mental well-being.'
        }
      ],
      eventClick: function(info) {
        alert('Event: ' + info.event.title + '\n' + info.event.extendedProps.description);
      }
    });

    eventsCalendar.render();
  });
</script>

</body>
</html>

