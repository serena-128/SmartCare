@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-purple text-white text-center">
            <h4><i class="fas fa-user-edit me-2"></i>Edit Staff Member</h4>
        </div>
        <div class="card-body">

            {!! Form::model($staffMember, ['route' => ['staffmembers.update', $staffMember->id], 'method' => 'patch']) !!}


            <div class="mb-3">
    {!! Form::label('reportsto', 'Supervisor:') !!}
    {!! Form::select('reportsto', $supervisors, null, ['class' => 'form-select', 'placeholder' => 'Select Supervisor']) !!}
</div>



            <div class="mb-3">
                {!! Form::label('firstname', 'First Name:') !!}
                {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label('lastname', 'Last Name:') !!}
                {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label('staff_role', 'Staff Role:') !!}
                {!! Form::text('staff_role', null, ['class' => 'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label('contactnumber', 'Contact Number:') !!}
                {!! Form::text('contactnumber', null, ['class' => 'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <div class="mb-3">
                {!! Form::label('startdate', 'Start Date:') !!}
                {!! Form::date('startdate', \Carbon\Carbon::parse($staffMember->startdate), ['class' => 'form-control']) !!}
            </div>

            <div class="d-flex justify-content-start gap-2">
                {!! Form::submit('Update', ['class' => 'btn btn-purple']) !!}
                <a href="{{ route('staffmembers.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
