@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Complete Your Profile</h2>

    <form action="{{ route('nextofkin.complete-profile.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="relationshiptoresident" class="form-label">Relationship to Resident</label>
            <input type="text" class="form-control" name="relationshiptoresident" value="{{ old('relationshiptoresident', $nextOfKin->relationshiptoresident) }}" required>
        </div>

        <div class="mb-3">
            <label for="contactnumber" class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contactnumber" value="{{ old('contactnumber', $nextOfKin->contactnumber) }}" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" value="{{ old('address', $nextOfKin->address) }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Save & Continue</button>
    </form>
</div>
@endsection
