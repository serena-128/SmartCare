<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
              integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
              crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Livewire Styles -->
        @livewireStyles

        <!-- CSS Assets -->
        @if (file_exists(public_path('css/app.css')))
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @endif

        <!-- Vite (for Laravel 9+) -->
        @if (function_exists('vite'))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body>
        <!-- Bootstrap 5 Navbar -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="https://laravel.com/docs">Laravel Documentation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://laracasts.com/">Laravel Video Tutorials</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content (Dynamic Content Will Be Injected Here) -->
        <main class="container mt-4">
            @yield('content')
        </main>

        <!-- JS Assets -->
        @if (file_exists(public_path('js/app.js')))
            <script src="{{ asset('js/app.js') }}"></script>
        @endif

        <!-- Livewire Scripts -->
        @livewireScripts

        @stack('js_scripts')

        <!-- Bootstrap Bundle (Popper.js included) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
