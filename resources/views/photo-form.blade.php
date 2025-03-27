@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Upload Photo</h1>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="photo">Choose Photo</label>
      <input type="file" name="photo" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Upload Photo</button>
  </form>
</div>
@endsection
