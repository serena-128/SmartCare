@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="mb-3">🔍 Search Staff Profiles</h4>

    <form action="{{ route('staff.searchResults') }}" method="GET" class="d-flex">
        <input type="text" name="query" class="form-control me-2" placeholder="Enter name or role..." required>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>
@endsection
