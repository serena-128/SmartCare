@if(Auth::check())
    <script>window.location.href = "{{ route('dashboard') }}";</script>
@endif

<div class="container">
    <div class="header">
        <h1>Welcome to SmartCare</h1>
        <p>Providing seamless management for nursing homes.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Login to System</a>
    </div>
</div>
