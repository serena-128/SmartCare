@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <!-- Assign Shift Form -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Assign Shift</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('shifts.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="staff_member_id" class="form-label">Staff Member:</label>
                    <select name="staff_member_id" class="form-select" required>
                        <option value="">-- Select Staff Member --</option>
                        @foreach($staff as $member)
                            <option value="{{ $member->id }}" {{ old('staff_member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->firstname }} {{ $member->lastname }} ({{ $member->role }})
                            </option>
                        @endforeach
                    </select>
                    @error('staff_member_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Date:</label>
                        <input type="date" name="shift_date" class="form-control" value="{{ old('shift_date') }}" required>
                        @error('shift_date')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start Time:</label>
                        <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}" required>
                        @error('start_time')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Time:</label>
                        <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}" required>
                        @error('end_time')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Assign Shift</button>
            </form>

            @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
        </div>
    </div>

    <!-- Existing Shifts Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Existing Shifts</h5>
        </div>
        <div class="card-body">
            @if($shifts->isEmpty())
                <p class="text-muted">No shifts assigned yet.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Staff</th>
                            <th>Date</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shifts as $shift)
                            <tr>
                                <td>{{ $shift->staffMember->firstname ?? '' }} {{ $shift->staffMember->lastname ?? '' }}</td>
                                <td>{{ $shift->shift_date }}</td>
                                <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
                                <td>
                                    <!-- Edit -->
                                    <a href="{{ route('shifts.edit', $shift->id) }}" class="btn btn-sm btn-primary">✏️ Edit</a>

                                    <!-- Delete Button triggers Modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete{{ $shift->id }}">
                                        🗑️ Delete
                                    </button>

                                    <!-- Hidden Form -->
                                    <form id="deleteForm{{ $shift->id }}" action="{{ route('shifts.destroy', $shift->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                    <!-- Delete Confirmation Modal -->
                                    <div class="modal fade" id="confirmDelete{{ $shift->id }}" tabindex="-1" aria-labelledby="confirmDeleteLabel{{ $shift->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="confirmDeleteLabel{{ $shift->id }}">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this shift?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-danger" onclick="document.getElementById('deleteForm{{ $shift->id }}').submit();">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>

@push('scripts')
<script>
    // Auto-hide alerts after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => alert.remove());
    }, 4000);
</script>
@endpush

@endsection
