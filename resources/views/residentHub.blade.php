@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f2eaff;
    }
    .resident-hub {
        text-align: center;
        padding: 50px 0;
    }
    .resident-hub h2 {
        color: #4b0082;
        font-weight: bold;
        margin-bottom: 40px;
    }
    .feature-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 30px 20px;
        margin-bottom: 30px;
        transition: transform 0.2s ease-in-out;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-5px);
    }
    .feature-card img {
        max-width: 80px;
        margin-bottom: 15px;
    }
    .feature-card h5 {
        font-weight: bold;
        color: #4b0082;
    }
    .feature-card p {
        font-size: 14px;
        color: #555;
        min-height: 50px;
    }
</style>

<div class="container resident-hub">
    <h2>Resident Management Hub</h2>

    <div class="row justify-content-center">
        <div class="col-md-4 d-flex">
            <div class="feature-card w-100">
                <img src="{{ asset('pictures/view_residents.jpg') }}" alt="View Residents">
                <h5>View Residents</h5>
                <p>Browse through the complete resident list.</p>
                <a href="{{ route('residents.index') }}" class="btn btn-outline-primary">View</a>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="feature-card w-100">
                <img src="{{ asset('pictures/add_resident.png') }}" alt="Add Resident">
                <h5>Add New Resident</h5>
                <p>Register a new resident into the care system.</p>
                <a href="{{ route('residents.create') }}" class="btn btn-outline-success">Add</a>
            </div>
        </div>
        <div class="col-md-4">
        <div class="feature-card">
        <img src="{{ asset('pictures/search_resident.png') }}" alt="Search Resident">
        <h5>Search Resident</h5>
        <p>Quickly find residents by name, room, or DOB.</p>
        <a href="{{ route('residents.search') }}" class="btn btn-outline-info">Search</a>

    </div>
</div>

    </div>
</div>
@endsection
