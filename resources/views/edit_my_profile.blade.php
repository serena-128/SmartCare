@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit My Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('my.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <!-- Phone Number -->
        <div class="mb-3">
            <label for="contactnumber">Phone Number</label>
            <input type="text" name="contactnumber" value="{{ $staff->contactnumber }}" class="form-control">
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" name="address" value="{{ $staff->address }}" class="form-control">
        </div>

        <!-- Profile Picture -->
        <div class="mb-3">
            <label for="profile_picture">Profile Picture</label><br>
            @if($staff->profile_picture)
                <img src="{{ asset('storage/' . $staff->profile_picture) }}" width="100" class="mb-2 rounded">
            @endif
            <input type="file" name="profile_picture" class="form-control">
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
