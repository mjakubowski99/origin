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
    <body class="bg-light">
       
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
                <p class="lead"> Wpisujemy date przyjazdu i odjazdu w . Wyszukujemy interesujący nas pociąg, który ma jechać na interesującej nas trasie</p>
                <hr class="my-4">
                <p>Kazde pole musi być uzupełnione inaczej formularz nie przejdzie. Zostaniesz poinformowany o tym czy sukcesywnie
                udało ci się dodać przejazd do bazy danych.</p>
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
       
       
                <form id="form-arrives" action="/customizeArrives" method="POST" class="text-center text-light p-3 bg-info" style=" border: 2px solid #f2f2f2; border-radius: 6px;">
                    @csrf 
                    <div class="h1"> Dodaj przejazd </div>

                    <div class="lists row ml-auto mr-auto" style="border-top: 2px solid #f2f2f2;">
                        <div class="col-md-3 col-xs-6">
                                <label for="begin-at"> Godzina odjazdu </label><br>
                                <input type="text" name="begin-at" class="form-control"><br>
                        </div>
                        <div class="col-md-3 col-xs-6">
                                <label for="arrive-at"> Godzina przyjazdu </label><br>
                                <input type="text" name="arrive-at" class="form-control">
                        </div>
                        <div class="col-md-3 col-xs-6 text-center">
                            <label for="train-search"> Wyszukaj pociąg </label><br>
                            <input type="text" id="train-search" name="train-search" class="form-control" data-toggle="collapse" href="#collapseTrains" role="button" aria-expanded="false" aria-controls="collapseTrains" >

                            <div class="collapse text-dark" id="collapseTrains">
                                <ul class="list-group text-center" id="trains">
                                    <li class="list-group-item text-center"></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-3 col-xs-6 text-center">
                            <label for="trace-search"> Wyszukaj trase </label><br>
                            <input type="text" name="trace-search" class="form-control" data-toggle="collapse" href="#collapseTraces" role="button" aria-expanded="false" aria-controls="collapseTraces"/>

                            <div class="collapse text-dark" id="collapseTraces">
                                <ul class="list-group text-center">
                                    @foreach( $traces as $trace )
                                        <li class="list-group-item text-center">{{ $trace->NAME }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <br> <input id="submiter" type="submit" value="Dodaj przejazd"class="btn btn-light text-dark text-light mb-2">
                </form>
    
            <script type="text/javascript">
               let trains =  <?php echo json_encode($trains) ?>;
               let input = document.getElementById('train-search');
               let trainsCollapse = document.getElementById('trains')

               input.addEventListener( 'keyup', (e) => {
                    $(trainsCollapse).empty();
                    $(trains).each( (index, element) => {
                        if( e.target.value != '' && element.name.startsWith( e.target.value ) ){
                            let listElement = document.createElement('li');
                            listElement.innerHTML = element.name;
                            listElement.setAttribute('class', 'list-group-item text-center')
                            trainsCollapse.appendChild(listElement);
                        }
                    });
               });

            </script>
    </body>
</html>