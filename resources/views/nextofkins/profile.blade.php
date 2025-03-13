<div class="container">
    <div class="profile-container text-center">
        <a href="{{ url('/dashboard#') }}" class="back-button">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
        <h1>Your Profile</h1>

        <!-- Show profile picture -->
        <div class="my-4">
            @if($nextOfKin->profile_picture)
                <img src="{{ asset('storage/' . $nextOfKin->profile_picture) }}" alt="Profile Picture" class="profile-img">
            @else
                <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="profile-img">
            @endif
        </div>

        <!-- Show success message -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Profile Update Form -->
        <form action="{{ route('nextofkin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="{{ $nextOfKin->firstname }}" required>
            </div>

            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $nextOfKin->lastname }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $nextOfKin->email }}" required>
            </div>

            <div class="mb-3">
                <label for="profile_picture" class="form-label">Upload Profile Picture</label>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture">
            </div>

            <button type="submit" class="btn btn-success w-100">Update Profile</button>
        </form>
    </div>
</div>
