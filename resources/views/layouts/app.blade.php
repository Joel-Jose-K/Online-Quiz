<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <input type="hidden" id="site-url" value="{{ url("/") }}">

    <title>@yield('title')</title>
    <link href="{{ asset('assets/cdn/font.google.css') }}" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/css/themes/lite-purple.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/styles/vendor/perfect-scrollbar.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/cdn/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/cdn/bootstrap-datetimepicker.min.css') }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/cdn/bootstrap-icons.css') }}">

    <style>
        .btn{
            width: 150px;
            margin-top: 5px;
            /* color: purple; */
        }
        label.error {
         color: #dc3545;
         font-size: 10px;
        }
    </style>
</head>

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large clearfix">
        @include('layouts.top-nav');

        @include('layouts.left-nav');
        <!--=============== Left side End ================-->

        <!-- ============ Body content start ============= -->
        <div class="main-content-wrap sidenav-open d-flex flex-column">

            @yield('content')

        </div>
        <!-- ============ Body content End ============= -->
    </div>
    <!--=============== End app-admin-wrap ================-->

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('assets/js/vendor/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/datatables.min.js') }}"></script>

    <script src="{{ asset('assets/js/es5/echart.options.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/dashboard.v2.script.min.js') }}"></script>

    <script src="{{ asset('assets/js/es5/script.min.js') }}"></script>
    <script src="{{ asset('assets/js/es5/sidebar.large.script.min.js') }}"></script>

    {{-- <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('assets/cdn/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/cdn/moment.min.js') }}"></script>
    <script src="{{ asset('assets/cdn/bootstrap-datetimepicker.min.js') }}"></script>
    

    @stack('scripts')
</body>

</html>