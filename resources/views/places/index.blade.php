<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}"> </script>
        <script src="https://code.jquery.com/jquery-1.12.4.js" integrity="sha384-KcyRSlC9FQog/lJsT+QA8AUIFBgnwKM7bxm7/YaX+NTr4D00npYawrX0h+oXI3a2" crossorigin="anonymous" ></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha384-JPbtLYL10d/Z1crlc6GGGGM3PavCzzoUJ1UxH0bXHOfguWHQ6XAWrIzW+MBGGXe5" crossorigin="anonymous" ></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/places.css') }}" rel="stylesheet">
    </head>
    <body class="bg-light">
          <div id="app">
                <!-- navbar -->
                <nav class="navbar navbar-expand-lg bg-primary">
                    <a class="navbar-brand text-light" href="{{url('/')}}">Train Service </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link text-light" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link text-light" href="{{ route('profile') }}"> Profile <span class="sr-only">(current)</span></a>
                            </li>
                        </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn text-light my-2 my-sm-0 bg-info" type="submit">Search</button>
                        </form>
                    </div>
                </nav>

                <div class="jumbotron text-center text-light mt-2 bg-dark" style="border: 1px solid; border-color: #f2f2f2;">
                        <h1 class="display-4">Witaj {{ Auth::user()->name }} </h1>
                        <p class="lead" >Wyszukaj interesujący ciebie pociąg.</p>
                        <hr class="my-4">
                        <p>Życzymy udanych zakupów i komfortowej podróży.</p>
                        <p class="lead">
                        <a class="btn btn-lg text-light btn-success" href="#" role="button">Zobacz swoje bilety</a>
                        </p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger text-center">
                        <p>{{ Session::get('error') }}</p>
                    </div>
                @endif

                <form class="text-center mt-5 mb-5" id="trace-form" action="/buyTicket" method="POST" autocomplete="off">
                        @csrf
                        <div class="col-md-6 shadow-box center bg-white box" style="background-color: #e6e6e6;">
                            <h1 class="h1 pt-5 text-dark" style="border-bottom: 1px solid; border-color:#e6e6e6;"> Wybierz przejazd </h1>
                            <div class="pb-5" style="border-bottom: 1px solid; border-color: #e6e6e6;">
                                <input class="col-6 mt-5 input-btn" id="trace-search-1" name="trace-input-1" placeholder="Ze stacji" type="search" aria-label="Search"/>
                                <ul class="ml-5 mr-5 list-group text-center text-dark" id="traces-1"> </ul>
                                <input class="col-6 mt-5 input-btn" id="trace-search-2" name="trace-input-2" placeholder="Do stacji" type="search" aria-label="Search"/>
                                <ul class="ml-5 mr-5 list-group text-center text-dark" id="traces-2"> </ul>
                            </div>
                            <div class="row pb-5 d-flex justify-content-center" >
                                <input class="col-4 mt-5 mr-2 input-btn" id="date" name="date-input" placeholder="Wpisz date" type="search" aria-label="Search"/>
                                <input class="col-4 mt-5 ml-2 input-btn" id="hour" name="hour-input" placeholder="Wpisz godzine" type="search" aria-label="Search"/>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg mb-3"> Szukaj </button>
                        </div>
                </form>

          <div class="text-light text-center bg-dark">
               TrainService@2020 Żadne prawa zastrzeżone
          </div>

        </div>

          <script type="text/javascript">
                 $( document ).ready(function() {
                    const stations =  <?php echo json_encode($stations) ?>;
                    let inputTrace1 = document.getElementById('trace-search-1');
                    let tracesCollapse1 = document.getElementById('traces-1');
                    let inputTrace2 = document.getElementById('trace-search-2');
                    let tracesCollapse2 = document.getElementById('traces-2');

                    console.log(stations);
                    tracesCollapse1.addEventListener('click', (e) => {
                        $(tracesCollapse1).empty();
                    });

                    tracesCollapse2.addEventListener('click', (e) => {
                        $(tracesCollapse2).empty();
                    });

                    
                    function setEventToSearcher(input, collapse, jsonObj){
                        input.addEventListener( 'keyup', (e) => {
                                $(collapse).empty();
                                $(jsonObj).each( (index, element) => {
                                    if( e.target.value != '' && ( element.name.startsWith( e.target.value ) || element.name.toLowerCase().startsWith( e.target.value ) ) ){
                                        let listElement = document.createElement('button');
                                        listElement.innerHTML = element.name
                                        listElement.setAttribute('class', 'list-group-item text-center')
                                        listElement.setAttribute('type', 'button');
                                        listElement.addEventListener('click', ()=>{
                                            input.value = element.name
                                        } );
                                        collapse.appendChild(listElement);
                                    }
                                });
                        });
                    }
                    setEventToSearcher(inputTrace1, tracesCollapse1, stations);
                    setEventToSearcher(inputTrace2, tracesCollapse2, stations);

                    const inputDate = document.getElementById('date');
                    $(inputDate).datepicker({
                        dateFormat: "yy-mm-dd"
                    });
                 });
          </script>

    </body>
</html>