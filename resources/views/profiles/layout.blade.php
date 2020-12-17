<!doctype html>
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
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    
</head>
<body class="bg-light">
    <nav class="navbar fixed-top navbar-expand-md bg-white" style="border-bottom: 2px solid: black; border-top: 2px solid: black;" >
        <div class="container">
            
            <a class="text-dark h2" href="{{ url('/') }}">
                TrainService
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="mr-2 auth-link text-dark h5 mr-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="ml-2 text-dark auth-link h5" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link text-dark dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item btn btn-primary text-dark" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <a class="dropdown-item btn btn-primary" href="{{ route('profile') }} "> Profil </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

<div class="jumbotron text-light text-center" style="background: url('{{ asset('storage/forms-photo.jpg') }}') no-repeat center center fixed">
    <h1 class="display-4 mt-5 mb-5"> Witaj {{ Auth::user()->name }} </h1>
    <input type="search" class="w-25 form-control ml-auto mr-auto" placeholder="Zobacz nadjezdzajace pociagi"/>
    <button type="submit" class="btn text-light mt-1" style="background-color: #9933ff;"> Wyszukaj </button>
</div>

<div class="d-flex ml-auto mr-auto w-75">
    <div class="bg-light mr-3 w-25" style="border: 1px solid #e6e6e6; border-radius: 10px;">
       <div class="header h5 text-center p-3" style="border-bottom: 1px solid #e6e6e6; font-weight: bold;">
            LISTA WIADOMOŚCI
       </div>
       <div class="messages h5 text-center">
            Ta sekcja jest na razie pusta
       </div>
    </div>

    <div class="w-75 bg-light ml-3 justify-content-center" style="border: 1px solid #e6e6e6; border-radius: 10px">
        <div class="text-center p-5" style="border-bottom: 1px solid #e6e6e6;">
             <div class="h5" style="font-weight: bold;"> Nasz system zapewnia możliwość sprawnych zakupów online </div>
             <div class="text-secondary" style="border-bottom: 1px solid #e6e6e6;"> Problemy techniczne są na bieżąco naprawiane </div>
             <br>
             <img src="{{asset('storage/image-for-profiles.jpg')}}" class="w-50"/>
             <br>
             <a href="{{ url('/buyTicket/traceFind') }}" class="btn text-light mt-1" style="background-color: #9933ff;"> Kup bilet </a>
        </div>
        <div class="text-center p-5" style="border-bottom: 1px solid #e6e6e6;">
            <div class="h5" style="font-weight: bold;"> Nasz system zapewnia możliwość sprawnych zakupów online </div>
            <br>
            <img src="{{asset('storage/image-for-profiles.jpg')}}" class="w-50"/>
            <br>
            <button type="search" class="btn text-light mt-1" style="background-color: #9933ff;"> Kup bilet </button>
       </div>
       <div class="text-center p-5" style="border-bottom: 1px solid #e6e6e6;">
        <div class="h5" style="font-weight: bold;"> Nasz system zapewnia możliwość sprawnych zakupów online </div>
        <br>
        <img src="{{asset('storage/image-for-profiles.jpg')}}" class="w-50"/>
        <br>
        <button type="search" class="btn text-light mt-1" style="background-color: #9933ff;"> Kup bilet </button>
        </div>
        
    </div>
</div>

</body>

</html>
