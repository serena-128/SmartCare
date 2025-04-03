@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- SmartCare Logo -->
    <div class="text-center">
        <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo" style="max-width: 200px;">
    </div>

    <h2 class="text-center text-purple mt-3">Edit Care Plan</h2>

    <div class="card shadow-lg border-0">
        <div class="card-body bg-light-purple p-4">
            <form action="{{ route('careplans.update', $careplan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Resident Name -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Resident Name</label>
                    <input type="text" class="form-control" value="{{ $careplan->resident->firstname }} {{ $careplan->resident->lastname }}" readonly>
                </div>

                <!-- Room Number -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Room Number</label>
                    <input type="text" class="form-control" value="{{ $careplan->resident->roomnumber }}" readonly>
                </div>

                <!-- Staff Member -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Assigned Staff Member</label>
                    <select class="form-select" name="staffmember_id" required>
                        @foreach($staffMembers as $staff)
                            <option value="{{ $staff->id }}" {{ $staff->id == $careplan->staffmember_id ? 'selected' : '' }}>
                                {{ $staff->firstname }} {{ $staff->lastname }} - {{ $staff->staff_role }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Care Goals -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Care Goals</label>
                    <input type="text" name="caregoals" class="form-control" value="{{ $careplan->caregoals }}" required>
                </div>

                <!-- Care Treatment -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Care Treatment</label>
                    <input type="text" name="caretreatment" class="form-control" value="{{ $careplan->caretreatment }}" required>
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Notes</label>
                    <textarea name="notes" class="form-control" rows="3" required>{{ $careplan->notes }}</textarea>
                </div>
                <div class="mb-3">
    <label for="assessment_summary" class="form-label">Assessment Summary</label>
    <textarea class="form-control" name="assessment_summary" rows="3" required>{{ $careplan->assessment_summary }}</textarea>
</div>

<div class="mb-3">
    <label for="diagnosis" class="form-label">Diagnosis</label>
    <textarea class="form-control" name="diagnosis" rows="2" required>{{ $careplan->diagnosis }}</textarea>
</div>

<div class="mb-3">
    <label for="evaluation_notes" class="form-label">Evaluation Notes</label>
    <textarea class="form-control" name="evaluation_notes" rows="2" required>{{ $careplan->evaluation_notes }}</textarea>
</div>

<div class="mb-3">
    <label for="status" class="form-label">Status</label>
    <select class="form-control" name="status" required>
        <option value="Active" {{ $careplan->status === 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ $careplan->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
        <option value="Completed" {{ $careplan->status === 'Completed' ? 'selected' : '' }}>Completed</option>
    </select>
</div>


                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">Update Care Plan</button>
                    <a href="{{ route('careplans.index') }}" class="btn btn-secondary btn-lg">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Light Purple Theme -->
<style>
    .bg-light-purple {
        background-color: #f4e6ff;
        border-radius: 10px;
    }
    .text-purple {
        color: #6a0dad;
    }
</style>
@endsection
