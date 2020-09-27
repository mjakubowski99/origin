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

            <div class="row mt-5 ml-5 mr-5">
                @foreach($founded_arrives as $founded_arrive )
                    <div class="card col-sm-12 mt-1 col-md text-center bg-dark">
                        <h5 class="card-header"> @yield('calendar-icon') Lublin-Warszawa</h5>
                        <div class="card-body pb-5">
                            <h3 class="card-header">Pociąg tlk200</h5>
                            <p class="card-text h1"> 11:20 <button class="btn btn-primary"> >> </button> 15:30</p>
                            <a href="#" class="btn btn-success">Zobacz trasę</a>
                            <a href="#" class="btn btn-success">Kup bilet</a>
                        </div>
                    </div>
                @endforeach
            </div>
          
            
        </div>

    </body>
</html>