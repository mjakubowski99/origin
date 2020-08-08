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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"> </script> 
    </head>
    <body>
       
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
                <a class="navbar-brand text-light" href="{{url('/')}}">Train Service </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse bg-info" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-light" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>

            <div class="jumbotron text-center">
                <h1 class="display-4">Obsluga</h1>
                <p class="lead"> Wpisujemy nazwe trasy i uzywajac przycisku Dodaj stacje dodajemy po kolei stacje i na koniec klikamy przycisk dodaj trase.</p>
                <hr class="my-4">
                <p>Kazde pole musi być uzupełnione inaczej formularz nie przejdzie. Zostaniesz poinformowany o tym czy sukcesywnie
                udało ci się dodać trasę do bazy danych.</p>
            </div>
        


     
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">
                    <p>{{ Session::get('error') }}</p>
                </div>
            @endif
       
       
            <div class="border-top pt-5">
                <form id="form-stations" action="/customizeStation" method="POST" class="text-center p-5">
                    @csrf 
                    <div class="h1"> Dodaj trase </div>
                    <label for="trace_name"> Nazwa trasy </label><br>
                    <input type="text" id="trace_name" name="trace_name"><br>
                    <button type="button" class="btn btn-info text-light mb-3 mt-3" id="add-station"> Dodaj stacje </button>
                    <div id="stations"> <h1 class="h1"> Stacje: </h1> </div> <!-- there will be appended stations inputs -->
                    <br> <input hidden id="submiter" type="submit" value="Dodaj trase" class="btn btn-info text-light">
                </form>
            </div>
    
            <script src="{{asset('js/stations.js')}}">
            </script>
    </body>
</html>