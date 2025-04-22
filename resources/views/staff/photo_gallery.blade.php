@extends('layouts.app')

@section('title', 'Photo Gallery')

@section('content')
<div class="container text-center mt-4">
    <h1 class="mb-4">Photo Gallery</h1>

    <!-- Toggle Button -->
    <div class="mb-4 text-end">
        <button class="btn btn-dark" id="toggleView">
            🗂️ View as Grid
        </button>
    </div>

    <!-- Carousel View -->
    <div id="carouselView">
        <div id="photoCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($photos as $index => $photo)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset($photo->filename) }}"
                             class="d-block mx-auto rounded"
                             alt="Photo"
                             style="height: 300px; width: 80%; object-fit: cover;">
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
    </div>

    <!-- Grid View -->
    <div id="gridView" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 d-none">
        @foreach($photos as $photo)
            <div class="col">
                <img src="{{ asset($photo->filename) }}"
                     class="img-fluid rounded"
                     alt="Photo"
                     style="height: 200px; object-fit: cover; width: 100%;">
            </div>
        @endforeach
    </div>
</div>

<!-- Toggle Script -->
<script>
    document.getElementById('toggleView').addEventListener('click', function () {
        const carousel = document.getElementById('carouselView');
        const grid = document.getElementById('gridView');
        const button = this;

        if (carousel.classList.contains('d-none')) {
            carousel.classList.remove('d-none');
            grid.classList.add('d-none');
            button.textContent = '🗂️ View as Grid';
        } else {
            carousel.classList.add('d-none');
            grid.classList.remove('d-none');
            button.textContent = '🎞️ View as Carousel';
        }
    });
</script>
@endsection
