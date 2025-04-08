@extends('layouts.app')

@section('content')
<div class="container">
    <h2>👤 My Profile</h2>
    <div class="card p-4">
        <p><strong>Name:</strong> {{ $staff->firstname }} {{ $staff->lastname }}</p>
        <p><strong>Email:</strong> {{ $staff->email }}</p>
        <p><strong>Phone:</strong> {{ $staff->phone ?? 'N/A' }}</p>
        <p><strong>Role:</strong> {{ $staff->staff_role ?? 'N/A' }}</p>
    </div>
</div>
@endsection
