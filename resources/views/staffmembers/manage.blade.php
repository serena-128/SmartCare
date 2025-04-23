@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>👥 Staff Profiles</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $member)
                <tr>
                    <td>{{ $member->firstname }} {{ $member->lastname }}</td>
                    <td>{{ $member->staff_role }}</td>
                    <td>{{ $member->contactnumber }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
