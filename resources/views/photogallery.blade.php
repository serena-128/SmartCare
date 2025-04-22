<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Photo Gallery - SmartCare</title>
  <!-- Bootstrap CSS for basic styling (optional) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container my-5">
    <h1 class="mb-4">Photo Gallery</h1>
    <div class="row">
      @forelse($photos as $photo)
        <div class="col-md-4 mb-3">
          <!-- Adjust the asset path based on where your images are stored -->
          <img src="{{ asset('storage/photos/' . $photo->filename) }}" alt="Photo" class="img-fluid">
        </div>
      @empty
        <p>No photos available at this time.</p>
      @endforelse
    </div>
  </div>
  <!-- Optional: Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
