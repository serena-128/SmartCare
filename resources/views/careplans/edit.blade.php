@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Care Plan</h2>

    <form action="{{ route('careplans.update', $careplan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Resident Selection -->
        <div class="mb-3">
            <label class="form-label">Resident:</label>
            <select name="residentid" class="form-control" required>
                @foreach($residents as $resident)
                    <option value="{{ $resident->id }}" {{ $careplan->residentid == $resident->id ? 'selected' : '' }}>
                        {{ $resident->firstname }} {{ $resident->lastname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Staff Member Selection -->
        <div class="mb-3">
            <label class="form-label">Assigned Staff Member:</label>
            <select name="staffmemberid" class="form-control" required>
                @foreach($staffMembers as $staff)
                    <option value="{{ $staff->id }}" {{ $careplan->staffmemberid == $staff->id ? 'selected' : '' }}>
                        {{ $staff->firstname }} {{ $staff->lastname }} ({{ $staff->staff_role }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Care Goals -->
        <div class="mb-3">
            <label class="form-label">Care Goals:</label>
            <input type="text" name="caregoals" class="form-control" value="{{ $careplan->caregoals }}" required>
        </div>

        <!-- Care Treatment -->
        <div class="mb-3">
            <label class="form-label">Care Treatment:</label>
            <input type="text" name="caretreatment" class="form-control" value="{{ $careplan->caretreatment }}" required>
        </div>

        <!-- Notes -->
        <div class="mb-3">
            <label class="form-label">Notes:</label>
            <textarea name="notes" class="form-control" rows="3">{{ $careplan->notes }}</textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Care Plan</button>
        <a href="{{ route('careplans.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
