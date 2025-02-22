@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Care Plan</h2>
    <form method="POST" action="{{ route('care-plans.store') }}">
        @csrf
        <div class="form-group">
            <label for="plan_details">Care Plan Details</label>
            <textarea name="plan_details" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success mt-2">Save Plan</button>
    </form>
</div>
@endsection
