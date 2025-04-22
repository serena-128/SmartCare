<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Photo Gallery - SmartCare</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #E6E6FA, #D8BFD8);
      color: #333;
    }

    .container {
      margin-top: 40px;
    }

    .carousel-inner img {
      height: 500px;
      object-fit: cover;
      border-radius: 12px;
    }

    .carousel-caption {
      background: rgba(0, 0, 0, 0.4);
      border-radius: 10px;
    }

    .btn-back {
      background-color: #800080;
      color: #fff;
      border: none;
      margin-bottom: 20px;
    }

    .btn-back:hover {
      background-color: #5c005c;
    }

    h1 {
      color: #4B0082;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container text-center">
    <a href="{{ route('nextofkins.dashboard') }}" class="btn btn-back">
  <i class="fas fa-arrow-left"></i> Back to Dashboard
</a>


    <h1 class="mb-4">Photo Gallery</h1>

    @if($photos->count() > 0)
      <div id="photoCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach($photos as $index => $photo)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
              <img src="{{ asset($photo->filename) }}" class="d-block w-100" alt="Photo">
            </div>
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#photoCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#photoCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
      </div>
    @else
      <p>No photos available at this time.</p>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
