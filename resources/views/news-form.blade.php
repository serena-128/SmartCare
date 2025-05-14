@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white fw-bold">
          Add News
        </div>
        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <form action="{{ route('news.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">News Title</label>
              <input type="text" name="title" class="form-control" id="title" required>
            </div>

            <div class="mb-3">
              <label for="date" class="form-label">News Date</label>
              <input type="date" name="date" class="form-control" id="date" required>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">News Description</label>
              <textarea name="description" class="form-control" id="description" rows="4" required></textarea>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Add News</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
