@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-purple text-white d-flex align-items-center">
            <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Add New Staff Member</h4>
        </div>
        <div class="card-body">
            {!! Form::open(['route' => 'staffmembers.store']) !!}
            <div class="row g-3">

                <!-- Firstname Field -->
                <div class="form-group col-md-6">
                    {!! Form::label('firstname', 'First Name', ['class' => 'form-label fw-bold text-purple']) !!}
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        {!! Form::text('firstname', null, ['class' => 'form-control', 'placeholder' => 'Enter first name']) !!}
                    </div>
                </div>

                <!-- Lastname Field -->
                <div class="form-group col-md-6">
                    {!! Form::label('lastname', 'Last Name', ['class' => 'form-label fw-bold text-purple']) !!}
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Enter last name']) !!}
                    </div>
                </div>

                <!-- Staff Role Field -->
                <div class="form-group col-md-6">
                    {!! Form::label('staff_role', 'Staff Role', ['class' => 'form-label fw-bold text-purple']) !!}
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                        {!! Form::text('staff_role', null, ['class' => 'form-control', 'placeholder' => 'Enter role']) !!}
                    </div>
                </div>

                <!-- Contactnumber Field -->
                <div class="form-group col-md-6">
                    {!! Form::label('contactnumber', 'Contact Number', ['class' => 'form-label fw-bold text-purple']) !!}
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        {!! Form::text('contactnumber', null, ['class' => 'form-control', 'placeholder' => 'Enter contact number']) !!}
                    </div>
                </div>

                <!-- Email Field -->
                <div class="form-group col-md-6">
                    {!! Form::label('email', 'Email', ['class' => 'form-label fw-bold text-purple']) !!}
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Enter email']) !!}
                    </div>
                </div>

                <!-- Startdate Field -->
                <div class="form-group col-md-6">
                    {!! Form::label('startdate', 'Start Date', ['class' => 'form-label fw-bold text-purple']) !!}
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        {!! Form::date('startdate', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4 text-end">
                {!! Form::submit('Save Staff Member', ['class' => 'btn btn-purple']) !!}
                <a href="{{ route('staffmembers.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection