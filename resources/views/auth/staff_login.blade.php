@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
        <h3 class="text-center mb-3">👨‍⚕️ Staff Login</h3>

        @if($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('staff.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">📧 Email Address</label>
                <input type="email" name="email" class="form-control" required placeholder="Enter your email">
            </div>

            <div class="mb-3">
                <label class="form-label">🔑 Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter your password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>
@endsection
