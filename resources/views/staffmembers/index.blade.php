@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Staff Members</h2>
        <a href="{{ route('staffmembers.create') }}" class="btn btn-purple">➕ Add New</a>
    </div>

    <!-- Search & Filter Form -->
    <form method="GET" action="{{ route('staffmembers.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by name, role, or email">
        </div>
        <div class="col-md-3">
            <select name="role" class="form-select" onchange="this.form.submit()">
                <option value="">All Roles</option>
                <option value="Nurse" {{ request('role') == 'Nurse' ? 'selected' : '' }}>Nurse</option>
                <option value="Doctor" {{ request('role') == 'Doctor' ? 'selected' : '' }}>Doctor</option>
                <option value="Care Assistant" {{ request('role') == 'Care Assistant' ? 'selected' : '' }}>Care Assistant</option>
                <option value="HR Coordinator" {{ request('role') == 'HR Coordinator' ? 'selected' : '' }}>HR Coordinator</option>
                <option value="Manager" {{ request('role') == 'Manager' ? 'selected' : '' }}>Manager</option>
                <option value="Operations Manager" {{ request('role') == 'Operations Manager' ? 'selected' : '' }}>Operations Manager</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-outline-primary w-100">Search</button>
        </div>
    </form>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('staffMembers.table')
            </div>
        </div>
    </div>

@endsection
