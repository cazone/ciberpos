<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" class="no-js">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset("assets/img/favicon.png")}}">
    	<link rel="stylesheet" href="{{ asset("assets/css/bootstrap.min.css")}}">
    	<link rel="stylesheet" href="{{ asset("assets/plugins/fontawesome/css/fontawesome.min.css")}}">
    	<link rel="stylesheet" href="{{ asset("assets/plugins/fontawesome/css/all.min.css")}}">
    	<link rel="stylesheet" href="{{ asset("assets/css/style.css")}}">

        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>


    </head>
    <body>
        @inertia
        <div id="global-loader" >
            <div class="whirly-loader"> </div>
        </div>
        @env ('local')
            <script src="http://localhost:3000/browser-sync/browser-sync-client.js"></script>
        @endenv
        <script src="{{ asset("assets/js/jquery-3.6.0.min.js")}}"></script>
    

        <!-- Feather Icon JS -->
        <script src="{{ asset("assets/js/feather.min.js")}}"></script>

        <!-- Slimscroll JS -->
        <script src="{{ asset("assets/js/jquery.slimscroll.min.js")}}"></script>

        <!-- Bootstrap Core JS -->
        <script src="{{ asset("assets/js/bootstrap.bundle.min.js")}}"></script>

        <!-- Custom JS -->
        {{-- <script src="{{ asset("assets/js/script.js")}}"></script> --}}
    </body>
        <!-- Jquery Core Js -->

</html>
