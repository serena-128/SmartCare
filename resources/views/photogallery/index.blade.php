<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Photo Gallery - SmartCare</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .gallery-title {
      font-size: 2rem;
      font-weight: bold;
      color: #0d6efd;
    }

    .gallery-card {
      transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .gallery-card:hover {
      transform: scale(1.03);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .gallery-img {
      border-radius: 0.5rem;
      height: 250px;
      object-fit: cover;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container py-5">
    <h1 class="text-center gallery-title mb-5">SmartCare Photo Gallery</h1>

    <div class="row g-4">
      @foreach($photos as $photo)
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="card gallery-card border-0 shadow-sm">
            <img src="{{ asset('storage/photos/' . $photo) }}" alt="Photo" class="gallery-img">
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
