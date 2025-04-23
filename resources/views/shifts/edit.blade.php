@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0">✏️ Edit Shift</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('shifts.update', $shift->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Staff Member:</label>
                    <select name="staff_member_id" class="form-select" required>
                        <option value="">-- Select Staff --</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}" 
                                {{ $shift->staff_member_id == $member->id ? 'selected' : '' }}>
                                {{ $member->firstname }} {{ $member->lastname }} ({{ $member->role }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Date:</label>
                        <input type="date" name="shift_date" class="form-control" value="{{ $shift->shift_date }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start Time:</label>
                        <input type="time" name="start_time" class="form-control" value="{{ $shift->start_time }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Time:</label>
                        <input type="time" name="end_time" class="form-control" value="{{ $shift->end_time }}" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update Shift</button>
                <a href="{{ route('shifts.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
