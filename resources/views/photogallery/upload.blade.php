@extends('layouts.app')  <!-- or your main layout -->

@section('content')
<div class="container my-5">
  <h1>Upload a New Photo</h1>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="photo" class="form-label">Choose Photo</label>
      <input type="file" name="photo" id="photo" class="form-control" required>
      @error('photo')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    <button type="submit" class="btn btn-primary">Upload Photo</button>
  </form>
</div>
@endsection
