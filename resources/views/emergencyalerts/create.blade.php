@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f2eaff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-card {
        background-color: #f6eaff;
        border-radius: 16px;
        padding: 40px;
        margin: 40px auto;
        max-width: 800px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .form-card h2 {
        color: #7200b3;
        font-weight: bold;
        margin-bottom: 30px;
        text-align: center;
    }

    label {
        font-weight: bold;
        color: #4b0082;
        margin-top: 20px;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
        font-size: 16px;
        margin-bottom: 10px;
    }

    .btn-danger {
        background-color: #b30059;
        border: none;
        padding: 10px 30px;
        font-size: 18px;
        margin-top: 20px;
        border-radius: 8px;
    }

    .btn-danger:hover {
        background-color: #99004d;
    }
</style>

<div class="form-card">
    <h2>🚨 Trigger Emergency Alert</h2>

    @include('basic-template::common.errors')

    {!! Form::open(['route' => 'emergencyalerts.store']) !!}

    <div class="form-group">
        {!! Form::label('residentid', 'Resident Name') !!}
        {!! Form::select('residentid', $residents, null, ['class' => 'form-control', 'placeholder' => 'Select a resident', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('alerttype', 'Alert Type') !!}
        {!! Form::select('alerttype', ['Fall' => 'Fall', 'Medical Emergency' => 'Medical Emergency', 'Other' => 'Other'], null, ['class' => 'form-control', 'placeholder' => 'Select alert type', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('urgency', 'Urgency Level') !!}
        {!! Form::select('urgency', ['High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low'], null, ['class' => 'form-control', 'placeholder' => 'Select urgency', 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('details', 'Details') !!}
        {!! Form::textarea('details', null, ['class' => 'form-control', 'placeholder' => 'Enter emergency details', 'rows' => 3, 'required']) !!}
    </div>

    {!! Form::hidden('alerttimestamp', now()) !!}
    {!! Form::hidden('triggeredbyid', Session::get('staff_id')) !!}
    {!! Form::hidden('status', 'Pending') !!}

    <div class="text-center">
        {!! Form::submit('Submit Alert', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
</div>
@endsection
