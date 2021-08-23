<!--
*
*  INSPINIA - Responsive Admin Theme
*  version 2.9.3
*
-->

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('page_title', config('app.name'))</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{ asset('js/plugins/gritter/jquery.gritter.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- Styles --}}
    @stack('styles')
</head>

@if(isset($page) && $page == 'login')

<body class="pg-login">
    @else

    <body class="fixed-sidebar">
        @endif
        @yield('base_body', View::make('layouts.base.base_body'))

        <!-- Mainly scripts -->
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.js') }}"></script>
        <script src="{{ asset(mix('js/app.js')) }}"></script>
        <script src="{{ asset('js/ibuumerang/organization/binary_viewer.js') }}"></script>
        <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
        <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('js/plugins/jasny/jasny-bootstrap.min.js') }}"></script>

        <!-- Toastr -->
        <script src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>

        <!-- Basic js classes for the menu and navigation -->
        <script src="{{ asset('js/inspinia.js') }}"></script>
        <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

        <!-- System js - basic functions to be used like notification and ajax request -->
        <script src="{{ asset('js/ibuumerang/system.js') }}"></script>

        {{-- Modals --}}
        @stack('modals')

        {{-- Scripts --}}
        @stack('scripts')
    </body>

</html>