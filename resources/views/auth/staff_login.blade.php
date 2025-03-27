@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px;">
        <div class="text-center">
            <img src="{{ asset('images/carehome_logo.png') }}" alt="Care Home Logo" class="logo">
        </div>

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
                <input type="email" name="email" class="form-control rounded-pill" required placeholder="Enter your email">
            </div>

            <div class="mb-3">
                <label class="form-label">🔑 Password</label>
                <input type="password" name="password" class="form-control rounded-pill" required placeholder="Enter your password">
            </div>


            <button type="submit" class="btn btn-primary w-100 rounded-pill">Login</button>


        </form>
    </div>
</div>

<style>
    .logo {
        display: block;
        margin: 0 auto 20px;
        max-width: 180px;
    }
</style>
@endsection