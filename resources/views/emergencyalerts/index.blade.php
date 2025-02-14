@extends('layouts.app')

@section('content')
    <section class="content-header d-flex justify-content-between align-items-center">
        <h1 class="mb-0">Emergency Alerts</h1>
        <div>
            <strong>Logged in as:</strong> {{ session('staff_name') }}
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>
    </section>

    <div class="content mt-3">
        @include('flash::message')

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Emergency Alerts List</h5>
            </div>
            <div class="card-body">
                @include('emergencyalerts.table')
            </div>
        </div>
    </div>
@endsection

