@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shift Calendar</h1>
    <a href="{{ route('shifts.create') }}" class="btn btn-primary">Create New Shift</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Staff Member</th>
                <th>Role</th>
                <th>Shift Date</th>
                <th>Shift Time</th>
                <th>Shift Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shifts as $shift)
            <tr>
                <td>{{ $shift->staffmember->firstname }} {{ $shift->staffmember->lastname }}</td>
                <td>{{ $shift->role->roletype ?? 'No Role Assigned' }}</td>
                <td>{{ $shift->shiftdate }}</td>
                <td>{{ $shift->starttime }} - {{ $shift->endtime }}</td>
                <td>{{ ucfirst($shift->shifttype) }}</td>
                <td>
                    <a href="{{ route('shifts.edit', $shift->id) }}" class="btn btn-warning">Edit</a>
                    @if($shift->status != 'approved')
                    <a href="{{ route('shifts.approve', $shift->id) }}" class="btn btn-success">Approve</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
