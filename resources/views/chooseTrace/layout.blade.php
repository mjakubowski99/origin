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
                        <h5 class="card-header"> @yield('calendar-icon') {{$trace_begin}}-{{$trace_end}}</h5>
                        <div class="card-body pb-5">
                            <h3 class="card-header">Pociąg</h5>
                            <p class="card-text h1"> 11:20 <button class="btn btn-primary"> >> </button> 15:30</p>
                            <a class="btn btn-success" data-toggle="modal" data-target="#exampleModal" >Zobacz trasę</a>
                            <br/>
                            <form action="{{route('choosePlace')}}" method="POST">
                                @csrf
                                <input type="hidden" name="arrive_data" value="{{ json_encode($founded_arrive) }}" />
                                <label for="howManyPlaces"> Wpisz ilosc miejsc </label>
                                <input name="howManyPlaces" class="form-control" style="width: 50%; margin-left: auto; margin-right: auto;"/>
                                <button type="submit" class="btn btn-success"> Wybierz miejsce </button>
                            </form>
                        </div>

                        Przez:
                        <br/>
                        @foreach($founded_arrive as $f_arrive)
                                 {{ $f_arrive->ID_STATION }} Odjezdza o: {{ $f_arrive->begin_date }}
                            <br/> 
                        @endforeach
                    </div>

                @endforeach
            </div>
          
            
        </div>

    </body>
</html>