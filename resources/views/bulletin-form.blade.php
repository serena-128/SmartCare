@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white fw-bold">
          📢 Add Bulletin
        </div>

        <div class="card-body">
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <form action="{{ route('bulletin.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="date" class="form-label">Bulletin Date</label>
              <input type="date" name="date" id="date" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="message" class="form-label">Bulletin Message</label>
              <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Add Bulletin</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
