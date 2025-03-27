@extends('layouts.app') {{-- Adjust if you have a custom layout --}}
@section('content')
<div class="container">
  <h1>Add News</h1>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <form action="{{ route('news.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="title">News Title</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group mt-2">
      <label for="date">News Date</label>
      <input type="date" name="date" class="form-control" required>
    </div>
    <div class="form-group mt-2">
      <label for="description">News Description</label>
      <textarea name="description" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Add News</button>
  </form>
</div>
@endsection
