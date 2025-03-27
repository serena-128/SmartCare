<?php
$hour = date('H');
if ($hour < 12) {
    $greeting = "Good Morning";
} elseif ($hour < 18) {
    $greeting = "Good Afternoon";
} else {
    $greeting = "Good Evening";
}
?>
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
  #calendar, #events-calendar {
    width: 100% !important;
    height: auto !important;
    min-height: 600px;
    max-width: 1200px;
    margin: auto;
    padding: 20px;
    background: white; /* Change from white to transparent */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
    
      .dashboard-section h1 {
  font-size: 2.5rem;
  color: #2c3e50;
  font-weight: bold;
  margin-bottom: 20px;
}

.card {
  border-radius: 10px;
  margin-top: 15px;
}

.card-header {
  font-size: 1.2rem;
  padding: 15px;
}

.card-body {
  font-size: 1rem;
}

.card-body p {
  margin-bottom: 10px;
}

.card-body hr {
  border-top: 1px solid #ccc;
  margin: 20px 0;
}

.text-center {
  text-align: center;
}

.shadow-lg {
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
}

.mb-4 {
  margin-bottom: 1.5rem;
}

.bg-primary {
  background-color: #007bff;
}

.bg-success {
  background-color: #28a745;
}

.bg-warning {
  background-color: #ffc107;
}

.text-white {
  color: white;
}

/* Custom CSS for uniform image size */
.custom-img {
  width: 100%;   /* Makes the image responsive */
  height: 200px; /* Adjust the height to your desired size */
  object-fit: cover; /* Ensures the images fit within the dimensions without distortion */
}
      .footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #f8f9fa;
    padding: 10px;
    text-align: center;
    border-top: 1px solid #ddd;
}
      #calendar, #events-calendar {
    width: 100% !important;
    height: auto !important;
    min-height: 600px; /* Ensures visibility */
    max-width: 1200px; /* Prevents excessive stretching */
    margin: auto;
}

/* Notification Tab Styling */
.notification-tab {
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #ff66b2; /* Soft pink for the bell */
  color: white;
  padding: 12px;
  border-radius: 50%;
  font-size: 24px;
  cursor: pointer;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
  transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth background and transform transition */
  z-index: 9999; /* Ensure it's always above other content */
}

.notification-tab:hover {
  background-color: #ff3385; /* A slightly darker pink on hover */
  transform: scale(1.1); /* Slight scale effect on hover */
}

/* Notification Count Styling */
.notification-count {
  position: absolute;
  top: -4px;
  right: -4px;
  background-color: #ff0000; /* Red for the notification badge */
  color: white;
  font-size: 12px;
  border-radius: 50%;
  padding: 5px 8px;
  font-weight: bold;
  animation: bounce 1s infinite; /* Add bounce effect when there's a new notification */
}

/* Bounce animation for notification count */
@keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-10px);
  }
  60% {
    transform: translateY(-5px);
  }
}

/* Notification Dropdown Styling */
.notification-dropdown {
  position: fixed;
  top: 60px; /* Adjust to place below the bell */
  right: 20px;
  background-color: #fff4f9; /* Soft light pink background */
  border-radius: 8px;
  box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
  width: 270px;
  border: 1px solid #f5c6cb;
  display: none; /* Hidden by default */
  padding: 10px 15px;
  font-family: 'Arial', sans-serif;
  animation: slideDown 0.3s ease-out; /* Add smooth animation for dropdown */
  z-index: 9998; /* Ensure it's above other content, but below the notification icon */
}

/* Add an animation for the dropdown to appear smoothly */
@keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Notification Items Styling */
.notification-dropdown .list-group-item {
  padding: 12px 18px;
  border: none;
  border-radius: 8px;
  background-color: #f8d7da; /* Soft pink for items */
  color: #721c24;
  font-size: 14px;
  margin-bottom: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.notification-dropdown .list-group-item:hover {
  background-color: #f5c6cb; /* A lighter pink when hovered */
  color: #333;
  transform: translateX(3px); /* Slight shift to the right on hover for interactivity */
}

/* For new notifications */
.notification-dropdown .list-group-item.new-notification {
  background-color: #ffb3d9; /* A brighter pink for new notifications */
}

.notification-dropdown .list-group-item.new-notification:hover {
  background-color: #ff99cc;
}


  </style>
</head>
    <footer class="footer text-center py-3 mt-5 bg-light">
    <p class="mb-0">© {{ date('Y') }} SmartCare. All Rights Reserved.</p>
</footer>

<body>
     <!-- Notification Icon (Top-right corner) -->
  <div id="notification-tab" class="notification-tab">
    <i class="fas fa-bell"></i>
    <span id="notification-count" class="notification-count">3</span> <!-- Example count -->
  </div>
    <div id="notification-dropdown" class="notification-dropdown" style="display: none;">
  <ul class="list-group">
    <li class="list-group-item">New event RSVP available.</li>
    <li class="list-group-item">Your profile was updated successfully.</li>
    <li class="list-group-item">New message from a family member.</li>
  </ul>
</div>
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
        <a href="{{ url('/contact') }}" class="sidebar-link">
      <i class="fas fa-envelope"></i> Contact SmartCare
    </a>


        <!-- Logout form -->
        <form action="{{ route('nextofkin.logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
        </form>
          <!-- Profile Picture below the Logout Button -->
              <div class="text-center mt-3">
      <a href="{{ route('nextofkin.profile') }}">
        @if(Auth::guard('nextofkin')->user()->profile_picture)
          <img src="{{ asset('storage/' . Auth::guard('nextofkin')->user()->profile_picture) }}" 
               alt="Profile Picture" 
               class="img-thumbnail rounded-circle" 
               style="width: 150px; height: 150px; object-fit: cover;">
        @else
          <img src="{{ asset('images/default-profile.png') }}" 
               alt="Default Profile Picture" 
               class="img-thumbnail rounded-circle" 
               style="width: 150px; height: 150px; object-fit: cover;">
        @endif
      </a>
    </div>


      </div>

      <!-- Main Content -->
      <div class="col-md-10 content">
        
        <!-- Home Section (Two-Column Layout) -->
<div id="home" class="dashboard-section home-section">
  <h1>{{ $greeting }}, {{ Auth::user()->firstname }}!</h1>
  <h1>Today is: <strong>{{ now()->format('l, d M Y') }}</strong></h1>

  <p>Welcome to your SmartCare dashboard! Below you'll find your resident's information, and upcoming appointments and events.</p>

  <div class="row">
    <!-- Column 1: Resident Information -->
    <div class="col-md-6 border-end border-3" style="border-color: #4B0082;">
      <h3>Resident</h3>
      @if(isset($resident) && $resident)
        <div class="card">
          <div class="card-body">
            <h5>Resident Name: {{ $resident->firstname }} {{ $resident->lastname }}</h5>
            <p><strong>Room Number:</strong> {{ $resident->roomnumber }}</p>
            <p><strong>Age:</strong> {{ \Carbon\Carbon::parse($resident->dateofbirth)->age }}</p>
            <p><strong>Admission Date:</strong> {{ \Carbon\Carbon::parse($resident->admissiondate)->format('d M Y') }}</p>
          </div>
        </div>
      @else
        <div class="alert alert-warning">
          <strong>No resident assigned.</strong> Please contact the admin to link a resident.
        </div>
      @endif

      <!-- Resident's Photo Below the Resident Info -->
      <div class="text-center mt-4">
        <img src="{{ asset('pictures/resident.jpg') }}" alt="Resident" style="width: 300px; height: auto;">
      </div>
    </div>

    <!-- Column 2: Upcoming Appointments & Events -->
    <div class="col-md-6">
      <h3>Upcoming Appointments & Events</h3>
      <div class="card">
        <div class="card-header">Appointments</div>
        <div class="card-body">
          <p>Doctor Visit - 15th March 2025 at 10:00 AM</p>
          <p>Physical Therapy - 20th March 2025 at 2:30 PM</p>
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-header">Events</div>
        <div class="card-body">
          <p>Family Day - 25th March 2025</p>
          <p>Music Therapy Session - 30th March 2025</p>
        </div>
      </div>
    </div>
  </div> <!-- End of Row -->
</div>



        <!-- Other Sections -->
        <div id="resident" class="dashboard-section" style="display: none;">
  <h1 class="text-center mb-4">Resident Overview</h1>

  <div class="row">
    <!-- Column 1: Resident Information -->
    <div class="col-md-6">
      <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
          <h3>Resident Information</h3>
        </div>
        <div class="card-body">
          <h5>Full Name: {{ $resident->firstname ?? 'John Doe' }} {{ $resident->lastname ?? '' }}</h5>
          <p><strong>Room Number:</strong> {{ $resident->room_number ?? '101' }}</p>
          <p><strong>Current Care Level:</strong> {{ $resident->care_level ?? 'N/A' }}</p>
          <p><strong>Current Status:</strong> {{ $resident->status ?? 'N/A' }}</p>
          <p><strong>Assigned Caregiver:</strong> {{ $resident->caregiver_name ?? 'Emma Kavanagh' }}</p>
          <p><strong>Care Plan Status:</strong> {{ $resident->care_plan_status ?? 'Active' }}</p>
        </div>
      </div>
    </div>

    <!-- Column 2: Health Overview & Emergency Contact -->
    <div class="col-md-6">
      <div class="card shadow-lg mb-4">
        <div class="card-header bg-success text-white">
          <h3>General Health Overview & Emergency Contact</h3>
        </div>
        <div class="card-body">
          <p><strong>Recent Checkups:</strong> {{ $resident->recent_checkups ?? 'Routine Checkup' }}</p>
          <p><strong>Health Notes:</strong> {{ $resident->health_notes ?? 'N/A' }}</p>
          <hr>
          <p><strong>Emergency Contact Name:</strong> {{ $resident->emergency_contact_name ?? 'Care home' }}</p>
          <p><strong>Emergency Contact Number:</strong> {{ $resident->emergency_contact_phone ?? '01 234 4354' }}</p>
            <a href="#" class="btn btn-success mt-3">Download Report</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Additional Information Section -->
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-lg mb-4">
        <div class="card-header bg-warning text-white">
          <h3>Additional Information</h3>
        </div>
        <div class="card-body">
          <h5>Family History</h5>
          <p>{{ $resident->family_history ?? 'N/A' }}</p>

          <h5>Preferred Activities</h5>
          <p>{{ $resident->preferred_activities ?? 'Daily walk' }}</p>

          <h5>Notes from Caregivers</h5>
          <p>{{ $resident->caregiver_notes ?? 'No notes available' }}</p>
        </div>
      </div>
    </div>
  </div>

</div>


        <div id="appointments" class="dashboard-section" style="display: none;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Upcoming Appointments</h1>
        
    <div class="d-flex align-items-center">
            <input type="text" class="form-control" id="appointments-search" placeholder="Search appointments..." style="width: 250px; margin-right: 15px;">
        </div>
        <a href="{{ route('appointments.rsvp.form') }}" class="btn btn-primary">
            <i class="fas fa-check-circle"></i> RSVP to Appointment
        </a>
    </div>
    
    <p>View and manage upcoming appointments.</p>

          <!-- Calendar Container -->
          <div id="calendar"></div>
        </div>

        <div id="events" class="dashboard-section" style="display: none;">
  <!-- Title and RSVP Button in the same row using Flexbox -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Upcoming Events</h1>
      <div class="d-flex align-items-center">
        <input type="text" class="form-control" id="events-search" placeholder="Search events..." style="width: 250px; margin-right: 15px;">
    </div>
    
    <!-- RSVP Button linking to the RSVP form -->
<a href="{{ route('rsvp.form') }}" class="btn btn-primary">RSVP to Event</a>

  </div>

  <p>View upcoming activities and social events at the care home.</p>

  <!-- Calendar Container -->
  <div id="events-calendar"></div>
</div>



<div id="news" class="dashboard-section" style="display: none;">
  <h1 class="mb-4">Latest News & Updates</h1>
  
  <!-- Row for Latest News and Photo Gallery -->
  <div class="row">
    <!-- Latest News Column -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <i class="fas fa-newspaper"></i> Latest News
        </div>
        <div class="card-body">
          @if($newsUpdates->isEmpty())
            <p>No recent updates available.</p>
          @else
            <ul class="list-group">
              @foreach($newsUpdates as $news)
                <li class="list-group-item">
                  <strong>{{ $news->title }}</strong>
                  <p class="text-muted">{{ \Carbon\Carbon::parse($news->date)->format('M d, Y') }}</p>
                  <p>{{ $news->description }}</p>
                </li>
              @endforeach
            </ul>
          @endif
        </div>
      </div>
    </div>
    
    <!-- Photo Gallery Column -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-success text-white">
          <i class="fas fa-images"></i> Photo Gallery
        </div>
        <div class="card-body">
          <div class="row">
            @if($photoGallery->isEmpty())
              <p>No photos available at this time.</p>
            @else
              @foreach($photoGallery->take(2) as $photo)
                <div class="col-6 mb-3">
                  <img src="{{ asset($photo->filename) }}" alt="Event Photo" class="img-fluid custom-img">
                </div>
              @endforeach
            @endif
          </div>
          <a href="{{ route('photogallery') }}" class="btn btn-outline-primary btn-sm">View More</a>
        </div>
      </div>
    </div>
  </div> <!-- End of the first row -->

  <!-- Separate Row for Bulletin Board -->
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header bg-warning text-dark">
          <i class="fas fa-thumbtack"></i> Bulletin Board
        </div>
        <div class="card-body">
          @if($bulletinBoard->isEmpty())
            <p>No announcements at this time.</p>
          @else
            @foreach($bulletinBoard as $announcement)
              <p>
                <strong>{{ \Carbon\Carbon::parse($announcement->date)->format('M d, Y') }}:</strong>
                {{ $announcement->message }}
              </p>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</div>



        <div id="settings" class="dashboard-section" style="display: none;">
  <h1>Account Settings</h1>
  <p>Manage your notifications and account security settings.</p>
  
  <div class="row">
    <!-- Notification Preferences Section -->
    <div class="col-md-6">
      <div class="card mb-4">
        <div class="card-header bg-warning text-dark">
          <i class="fas fa-bell"></i> Notification Preferences
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('nextofkin.notifications.update') }}">
            @csrf
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="email_notifications" name="email_notifications"
                     {{ Auth::guard('nextofkin')->user()->email_notifications ? 'checked' : '' }}>
              <label class="form-check-label" for="email_notifications">
                Receive Email Notifications
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="sms_notifications" name="sms_notifications"
                     {{ Auth::guard('nextofkin')->user()->sms_notifications ? 'checked' : '' }}>
              <label class="form-check-label" for="sms_notifications">
                Receive SMS Alerts
              </label>
            </div>
            <div class="form-check mb-2">
              <input class="form-check-input" type="checkbox" id="carehome_updates" name="carehome_updates"
                     {{ Auth::guard('nextofkin')->user()->carehome_updates ? 'checked' : '' }}>
              <label class="form-check-label" for="carehome_updates">
                Receive Care Home Updates
              </label>
            </div>
            <button type="submit" class="btn btn-warning w-100 mt-3">Update Preferences</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Account Security (Password Update) Section -->
          <div class="col-md-6">
  <div class="card mb-4">
    <div class="card-header bg-secondary text-white">
      <i class="fas fa-lock"></i> Account Security
    </div>
    <div class="card-body">
      <!-- Display errors for the password update form here -->
      @if($errors->has('current_password') || $errors->has('new_password'))
        <div class="alert alert-danger">
          <ul class="mb-0">
            @if($errors->has('current_password'))
              <li>{{ $errors->first('current_password') }}</li>
            @endif
            @if($errors->has('new_password'))
              <li>{{ $errors->first('new_password') }}</li>
            @endif
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('nextofkin.password.update') }}">
        @csrf
        <div class="mb-3">
          <label for="current_password" class="form-label">Current Password</label>
          <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3">
          <label for="new_password" class="form-label">New Password</label>
          <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
        <div class="mb-3">
          <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
          <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-secondary w-100">Change Password</button>
      </form>
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
        
        if (sectionId === 'appointments' || sectionId === 'events') {
        document.getElementById('notification-tab').style.display = 'none';
      } else {
        document.getElementById('notification-tab').style.display = 'block';
      }

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
          

 <!-- Initialize FullCalendar for Appointments -->
  <script>
document.addEventListener('DOMContentLoaded', function() {
  var appointmentsCalendarEl = document.getElementById('calendar');
  if (appointmentsCalendarEl) {
    var appointmentsCalendar = new FullCalendar.Calendar(appointmentsCalendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      // Load appointments dynamically from the route:
      events: '{{ route("appointments.fetch") }}',
      eventClick: function(info) {
        alert('Appointment: ' + info.event.title + '\n' + info.event.extendedProps.description);
      }
    });
    appointmentsCalendar.render();
  }
});
</script>


  <script>
document.addEventListener('DOMContentLoaded', function() {
  var eventsCalendarEl = document.getElementById('events-calendar');
  if (eventsCalendarEl) {
    var eventsCalendar = new FullCalendar.Calendar(eventsCalendarEl, {
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      // Use Laravel route to fetch events
      events: '/fetch-events',
      eventClick: function(info) {
        alert('Event: ' + info.event.title + '\n' + info.event.extendedProps.description);
      }
    });
    eventsCalendar.render();
  }
});
</script>

<script>
document.getElementById('notification-tab').addEventListener('click', function() {
  var dropdown = document.getElementById('notification-dropdown');
  // Toggle the display property to show or hide the dropdown
  if (dropdown.style.display === 'none' || dropdown.style.display === '') {
    dropdown.style.display = 'block';  // Show the dropdown
  } else {
    dropdown.style.display = 'none';   // Hide the dropdown
  }
});

// Example to dynamically change the notification count
function updateNotificationCount(newCount) {
  var countElement = document.getElementById('notification-count');
  countElement.textContent = newCount;
}

// Example to add a new notification dynamically
function addNewNotification(message) {
  var dropdown = document.getElementById('notification-dropdown');
  var listItem = document.createElement('li');
  listItem.classList.add('list-group-item');
  listItem.textContent = message;
  dropdown.querySelector('.list-group').appendChild(listItem);
}
</script>
</body>
</html>

