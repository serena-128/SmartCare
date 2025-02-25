@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Log Emergency Alert</h2>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('emergencyalerts.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Resident</label>
            <select name="residentid" class="form-select" required>
                @foreach($residents as $resident)
                    <option value="{{ $resident->id }}">{{ $resident->firstname }} {{ $resident->lastname }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Alert Type</label>
            <select name="alerttype" class="form-select" required>
                <option value="Medical Emergency">Medical Emergency</option>
                <option value="Fire">Fire</option>
                <option value="Security Issue">Security Issue</option>
                <option value="Fall Detected">Fall Detected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-danger">Log Alert</button>
    </form>
</div>
@endsection
