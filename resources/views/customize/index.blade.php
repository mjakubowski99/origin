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

        <div class="bg-dark pt-3 pb-3">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/data.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-md-block" style="padding-bottom: 15%;">
                                 <div class="h1"> Panel dodawania pociągów </div>
                                <button class="btn btn-primary" onclick="window.location.href='{{route('customizeTrain')}}'"> Panel </button>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('storage/data.jpg') }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-md-block" style="padding-bottom: 15%;">
                                <div class="h1"> Panel dodawania kursów </div>
                                <button class="btn btn-primary" onclick="window.location.href='{{route('customizeTrain')}}'"> Panel </button>
                            </div>
                        </div>
                    </div>

                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
            </div>
        </div>

        <div class="h1 text-dark text-center p-3"> Specyfikacja dodawania </div> 
        <div class="h5 text-center"> Po wpisaniu nazwy pociągu i akceptacji pociąg pojawia się w bazie danych. I jest
        dostępny do twojej dyspozycji przy tworzeniu kursów.  <br> Strona udostępnia ci listę istniejących już pociągów. </br> </div>

    </body>
</html>