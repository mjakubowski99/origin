<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">   
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="train" style="background: linear-gradient(rgba(0, 0, 0, .6), rgba(0, 0, 0, .6)), url('{{asset('storage/train-bg.jpg')}}') no-repeat center center fixed;">
        <nav class="navbar fixed-top navbar-expand-md shadow-sm">
            <div class="container">
                
                <a class="text-light h2" href="{{ url('/') }}">
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
                                <a class="mr-2 auth-link h5 mr-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="ml-2 auth-link h5" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item btn btn-primary" href="{{ route('logout') }}"
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

        <div class="text-center text-light" style="margin-top: 10%;">
            <h1 class="display-4">Witamy w naszym serwisie!</h1>
            <p class="lead">Tutaj mozesz zakupić bilety na pociągi w całej Polsce.</p>
            <hr class="my-4">
            <p> Życzymy udanych zakupów i miłej podróży</p>
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
          </div>

          <div class="bg-light text-center" style="margin-top: 10%; border-bottom: 1px solid #f0f0f0">
                <div class="h1 pt-5 pb-5">
                    Nasze usługi  
                </div> 

                <div class="d-flex flex-row justify-content-center">
                    <div class="p-2">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Kupno biletów</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Konto użytkownika</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 pb-5">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Sprawdzanie harmonogramu</h5>
                              <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                  </div>
          </div>
    </body>
</html>
