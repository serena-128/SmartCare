<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Next of Kin Home - SmartCare</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
        integrity="sha512-pO9C7gJD4tZJ/6P7h72p8G3jO+vVKaFvyFHzcYs6Oa+G/3pJibwqRF7WUTl0pXQ4O+TVY9i8phMq8gXg6dD/1w==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        <a href="#" class="active"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-user"></i> Resident</a>
        <a href="#"><i class="fas fa-calendar-check"></i> Appointments</a>
        <a href="#"><i class="fas fa-calendar-alt"></i> Events</a>
        <a href="#"><i class="fas fa-newspaper"></i> News</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>

        <!-- Logout form -->
        <form action="{{ route('nextofkin.logout') }}" method="POST" class="logout-form">
          @csrf
          <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
      </div>
      <div class="col-md-10 content">
        <h1>Home</h1>
        <p>Welcome to your SmartCare dashboard! Below you'll find your resident's information, upcoming appointments and events, and the latest news.</p>
        
        <div class="row">
          <!-- Column 1: Resident -->
          <div class="col-md-4">
            <h3>Resident</h3>
            <div class="card">
              <div class="card-body">
                <!-- Replace with resident information -->
                <p>Resident information goes here.</p>
              </div>
            </div>
          </div>
          
          <!-- Column 2: Upcoming Appointments and Events -->
          <div class="col-md-4">
            <h3>Upcoming Appointments and Events</h3>
            <div class="card">
              <div class="card-header">Appointments</div>
              <div class="card-body">
                <!-- Appointments details -->
                <p>Appointment details go here.</p>
              </div>
            </div>
            <div class="card">
              <div class="card-header">Events</div>
              <div class="card-body">
                <!-- Events details -->
                <p>Event details go here.</p>
              </div>
            </div>
          </div>
          
          <!-- Column 3: News Section -->
          <div class="col-md-4">
            <h3>News Section</h3>
            <div class="card">
              <div class="card-header">Photo Gallery</div>
              <div class="card-body">
                <!-- Replace with photo gallery content -->
                <p>Photo gallery content goes here.</p>
              </div>
            </div>
            <div class="card">
              <div class="card-header">News Updates</div>
              <div class="card-body">
                <!-- Replace with news updates -->
                <p>News updates content goes here.</p>
              </div>
            </div>
            <div class="card">
              <div class="card-header">Bulletin Board</div>
              <div class="card-body">
                <!-- Replace with bulletin board content -->
                <p>Bulletin board content goes here.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

