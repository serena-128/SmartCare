@extends('layouts.app')
@section('content')
<div class="container">
  <h1>Add Bulletin</h1>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <form action="{{ route('bulletin.store') }}" method="POST">
    @csrf
    <div class="form-group">
      <label for="date">Bulletin Date</label>
      <input type="date" name="date" class="form-control" required>
    </div>
    <div class="form-group mt-2">
      <label for="message">Bulletin Message</label>
      <textarea name="message" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Add Bulletin</button>
  </form>
</div>
@endsection
