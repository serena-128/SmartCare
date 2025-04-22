@extends('layouts.app')

@section('content')
<div class="container mt-5">

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
                            <option value="{{ $member->id }}">
                                {{ $member->firstname }} {{ $member->lastname }} ({{ $member->role }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Date:</label>
                        <input type="date" name="shift_date" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start Time:</label>
                        <input type="time" name="start_time" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">End Time:</label>
                        <input type="time" name="end_time" class="form-control" required>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shifts as $shift)
                            <tr>
                                <td>{{ $shift->staffMember->firstname ?? '' }} {{ $shift->staffMember->lastname ?? '' }}</td>
                                <td>{{ $shift->shift_date }}</td>
                                <td>{{ \Carbon\Carbon::parse($shift->start_time)->format('H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($shift->end_time)->format('H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
@endsection
