@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="card text-white" style="background-color: purple;">
        <div class="card-body text-center">
            <h3 class="mb-0"><i class="fas fa-calendar-alt"></i> Appointments</h3>
        </div>
    </div>
    <div class="mt-3 text-end">
        <a class="btn btn-primary" href="{{ route('appointments.create') }}">
            <i class="fas fa-plus"></i> Add New
        </a>
    </div>
</section>

    <!-- Flash Messages -->
    @include('flash::message')

    <!-- Appointments Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @include('appointments.table')
        </div>
    </div>
</div>

@endsection
