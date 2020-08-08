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
                <form action="/customizeTrain" method="POST" class="text-center p-5">
                    @csrf 
                    <div class="h1"> Dodaj pociąg </div>
                    <label for="tname"> Nazwa </label><br>
                    <input type="text" id="tname" name="tname"><br>
                    <br> <input type="submit" value="Submit" class="btn btn-info text-light">
                </form>
            </div>
        

      
            <div class="border-top pt-5">
                <form action="/customizePlaces" method="POST" class="text-center p-5">
                    @csrf 
                    <div class="h1"> Dodaj wagon </div>
                    @if( Session::has('numericError') )
                        <div class="alert alert-danger text-center">
                            {{ Session::get('numericError') }}
                        </div>
                    @elseif( Session::has('added') )
                        <div class="alert alert-success text-center">
                            {{ Session::get('added') }}
                        </div>
                    @endif
                    <label for="train_id"> Id Pociągu: </label><br>
                    <input type="text" id="train_id" name="train_id"><br>
                    <label for="car_number"> Numer wagonu: </label><br>
                    <input type="text" id="car_number" name="car_number"><br>
                    <label for="place"> Liczba miejsc w wagonie: </label><br>
                    <input type="text" id="place" name="place"><br>
                    <br> <input type="submit" value="Submit" class="btn btn-info text-light">
                </form>
            </div>
      

        
            <div class="h1 text-center pt-5"> Lista pociągów </div>
            @if( count($trains) == 0 )
                <div class="alert alert-danger text-center">
                    Nie ma pociągów w bazie
                </div>
            @else
            <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                        <th scope="col">Id pociągu</th>
                        <th scope="col">Name</th>
                        <th scope="col">Miejsca</th>
                        <th scope="col">Liczba wagonów</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach( $trains as $train )
                            <tr>
                                <th scope="row"> {{ $train->id }} </th>
                                <td>{{ $train->name }}</td>
                                <td>Brak</td>
                                <td>Brak</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
    </body>
</html>