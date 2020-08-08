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
       
       
            <div class="pt-5 ml-5 mr-5">
                <form id="form-arrives" action="/customizeArrives" method="POST" class="text-center p-5" style=" border: 2px solid #f2f2f2; border-radius: 6px;">
                    @csrf 
                    <div class="h1"> Dodaj przejazd </div>
                    <label for="begin-at"> Godzina odjazdu </label><br>
                    <input type="text" name="begin-at"><br>
                    <label for="arrive-at"> Godzina przyjazdu </label><br>
                    <input type="text" name="arrive-at" class="mb-5"><br>

                    <div class="lists row ml-auto mr-auto" style="border-top: 2px solid #f2f2f2;">
                        <div class="col-6 text-center pt-5">
                            <a class="btn btn-info text-light mr-3" data-toggle="collapse" href="#collapseTrains" role="button" aria-expanded="false" aria-controls="collapseTrains">
                                    Pociagi
                            </a>

                            <div class="collapse" id="collapseTrains">
                                <ul class="list-group text-center">
                                    @foreach( $trains as $train )
                                        <li class="list-group-item w-50 text-center">{{ $train->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="col-6 text-center pt-5">
                            <a class="btn btn-info text-light" data-toggle="collapse" href="#collapseTraces" role="button" aria-expanded="false" aria-controls="collapseTraces">
                                    Trasy
                            </a>

                            <div class="collapse" id="collapseTraces">
                                <ul class="list-group text-center">
                                    @foreach( $traces as $trace )
                                        <li class="list-group-item w-50 text-center">{{ $trace->NAME }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <br> <input id="submiter" type="submit" value="Dodaj przejazd" class="btn btn-info text-light mb-2">
                </form>
            </div>
    
            <script src="{{asset('js/stations.js')}}">
            </script>
    </body>
</html>