<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Settings - SmartCare</title>

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

    .settings-card {
      max-width: 700px;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-md-2 sidebar">
        <a href="#" class="sidebar-link" onclick="showSection('home', this)"><i class="fas fa-home"></i> Home</a>
        <a href="#" class="sidebar-link" onclick="showSection('resident', this)"><i class="fas fa-user"></i> Resident</a>
        <a href="#" class="sidebar-link" onclick="showSection('appointments', this)"><i class="fas fa-calendar-check"></i> Appointments</a>
        <a href="#" class="sidebar-link" onclick="showSection('events', this)"><i class="fas fa-calendar-alt"></i> Events</a>
        <a href="#" class="sidebar-link" onclick="showSection('news', this)"><i class="fas fa-newspaper"></i> News</a>
        <a href="#" class="sidebar-link active" onclick="showSection('settings', this)"><i class="fas fa-cog"></i> Settings</a>

        <!-- Logout form -->
        <form action="{{ route('nextofkin.logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
        </form>
      </div>

      <!-- Main Content -->
      <div class="col-md-10 content">
        <div id="settings" class="dashboard-section">
          <h1>Settings</h1>
          <p>Update your account information and preferences.</p>

          <!-- Settings Card -->
          <div class="card settings-card">
            <div class="card-body">
              <h5 class="card-title"><i class="fas fa-user-cog"></i> Account Settings</h5>

              <!-- Update Profile -->
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

                <!-- Notification Preferences -->
                <h5 class="mt-4"><i class="fas fa-bell"></i> Notification Preferences</h5>

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

                <!-- Save Button -->
                <button type="submit" class="btn btn-primary w-100 mt-3">Save Changes</button>
              </form>
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
