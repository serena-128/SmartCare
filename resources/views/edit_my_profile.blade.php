@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit My Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('my.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="contactnumber" value="{{ $staff->contactnumber }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Profile Picture</label><br>
            @if($staff->profile_picture)
                <img src="{{ asset('storage/' . $staff->profile_picture) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="profile_picture" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
