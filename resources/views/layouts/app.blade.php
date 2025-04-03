<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <!-- Bootstrap 5 Navbar (Add if needed) -->

    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <!-- Left Side Space (for widescreen adjustment) -->
                <div class="col-lg-2"></div>

                <!-- Main Content -->
                <div class="col-lg-8"> 
                    @yield('content') 
                </div>

                <!-- Right Side Space (for widescreen adjustment) -->
                <div class="col-lg-2"></div>
            </div>
        </div>
<<<<<<< HEAD
        <!-- Webpack mix npm generated -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{asset('js/app.js')}}"></script>
        @stack('js_scripts')
<footer class="text-center mt-5 py-3 bg-light">
    <p>© {{ date('Y') }} SmartCare. All Rights Reserved.</p>
</footer>

    </body>
=======
    </div>

    <!-- ✅ Footer (Now Correctly Placed) -->
    @include('layouts.footer')

    <!-- Webpack Mix Assets -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('js_scripts')
</body>
>>>>>>> komal
</html>
