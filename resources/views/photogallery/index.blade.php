<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Photo Gallery - SmartCare</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .gallery img {
      width: 100%;
      height: auto;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <div class="container my-5">
    <h1 class="mb-4">Photo Gallery</h1>
    <div class="row gallery">
      @foreach($photos as $photo)
        <div class="col-md-4">
          <img src="{{ asset('storage/photos/' . $photo) }}" alt="Photo">
        </div>
      @endforeach
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
