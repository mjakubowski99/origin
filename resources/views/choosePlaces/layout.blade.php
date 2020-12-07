<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="text-light" style="background-color: #1a1a1a;">
        <div id="app">
            <navbar-component main-href="{{url('/')}}" home-href="{{url('home')}}" class="bg-success"> </navbar-component>
            
            <div class="bg-dark">
                <place-choose-component csrf="{{ csrf_token() }}" places="{{$places}}" pay-for-ticket-route="{{route('reasume')}}"> </place-choose-component>
            </div>
            
        </div>

    </body>
</html>