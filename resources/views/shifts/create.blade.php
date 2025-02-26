@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Shift</h1>
    <form action="{{ route('shifts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="staffmemberid">Staff Member</label>
            <select class="form-control" name="staffmemberid" required>
                @foreach($staffmembers as $staff)
                <option value="{{ $staff->id }}">{{ $staff->firstname }} {{ $staff->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="roleid">Role</label>
            <select class="form-control" name="roleid" required>
                @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->roletype }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="shiftdate">Shift Date</label>
            <input type="date" class="form-control" name="shiftdate" required>
        </div>

        <div class="form-group">
            <label for="starttime">Start Time</label>
            <input type="time" class="form-control" name="starttime" required>
        </div>

        <div class="form-group">
            <label for="endtime">End Time</label>
            <input type="time" class="form-control" name="endtime" required>
        </div>

        <div class="form-group">
            <label for="shifttype">Shift Type</label>
            <select class="form-control" name="shifttype" required>
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
                <option value="night">Night</option>
                <option value="emergency">Emergency on-call</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create Shift</button>
    </form>
</div>
@endsection
