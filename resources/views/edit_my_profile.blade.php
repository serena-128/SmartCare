@extends('layouts.app')

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<style>
    body {
        background: #f5f5f5;
    }
    .panel {
        border-radius: .25rem;
        box-shadow: 0 2px 6px rgba(218, 218, 253, 0.65), 0 2px 6px rgba(206, 206, 238, 0.54);
        background-color: white;
    }
    .profile-avatar {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    label {
        color: #6c757d;
        font-weight: 500;
    }
    .form-control[readonly] {
        background-color: #f8f9fa;
        border: none;
    }
</style>

<div class="container bootstrap snippets bootdeys mt-4">
    <div class="row">
        <div class="col-md-4 text-center">
            <div class="panel p-4">
                @if($staff->profile_picture)
                    <img src="{{ asset('storage/' . $staff->profile_picture) }}" class="profile-avatar" alt="Profile Image">
                @else
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="profile-avatar" alt="Default Avatar">
                @endif
                <h4 class="mt-2">{{ $staff->firstname }} {{ $staff->lastname }}</h4>
                <p class="text-muted">{{ $staff->staff_role }}</p>
                <p class="text-muted">{{ $staff->email }}</p>
            </div>
        </div>

        <div class="col-md-8">
            <form method="POST" action="{{ route('my.profile.update') }}" enctype="multipart/form-data" class="panel p-4" onsubmit="return confirmUpdate();">
                @csrf

                <h4 class="mb-3">Edit Profile</h4>

                <!-- READ-ONLY INFO -->
                <div class="form-group mb-3">
                    <label>Full Name</label>
                    <input type="text" value="{{ $staff->firstname }} {{ $staff->lastname }}" class="form-control" readonly>
                </div>

                <div class="form-group mb-3">
                    <label>Email</label>
                    <input type="text" value="{{ $staff->email }}" class="form-control" readonly>
                </div>

                <div class="form-group mb-3">
                    <label>Role</label>
                    <input type="text" value="{{ $staff->staff_role }}" class="form-control" readonly>
                </div>

                <!-- EDITABLE FIELDS -->
                <div class="form-group mb-3">
                    <label for="contactnumber">Phone Number</label>
                    <input type="text" name="contactnumber" value="{{ $staff->contactnumber }}" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <input type="text" name="address" value="{{ $staff->address }}" class="form-control">
                </div>

                <div class="form-group mb-4">
                    <label for="profile_picture">Profile Image</label>
                    <input type="file" name="profile_picture" class="form-control">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">💾 Save Changes</button>
                    <a href="{{ route('my.profile') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function confirmUpdate() {
        return confirm('Are you sure you want to update your profile?');
    }
</script>
@endsection
