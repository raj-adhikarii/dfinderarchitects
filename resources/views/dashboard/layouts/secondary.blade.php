<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">
        @yield('title')

        <!-- vendor css -->
        <link href="{{ asset('public/dashboard/lib/fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('public/dashboard/lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

        <!-- DashForge CSS -->
        <link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/dashforge.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/dashforge.dashboard.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/skin.cool.css') }}">
        <link rel="stylesheet" href="{{ asset('public/dashboard/assets/css/custom.css') }}">
        @yield('styles')
    </head>

    <body class="page-profile">

        @yield('content')

        <script src="{{ asset('public/dashboard/lib/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/feather-icons/feather.min.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/jquery.flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/jquery.flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/jquery.flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/chart.js/Chart.bundle.min.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/jqvmap/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('public/dashboard/lib/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

        <script src="{{ asset('public/dashboard/assets/js/dashforge.js') }}"></script>
        <script src="{{ asset('public/dashboard/assets/js/dashforge.sampledata.js') }}"></script>

        @yield('scripts')
    </body>

</html>