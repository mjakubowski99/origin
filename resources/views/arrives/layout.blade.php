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
        <script type="module" src="{{ asset('js/arrives.js') }}"> </script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-light">

          <!-- navbar -->
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

          <!-- jumbotron -->
          <div class="jumbotron text-center">
                  @yield('jumbotronContent')
          </div>
  
          <!-- error alerts -->
          @yield('errorsChecker')
  
  
          <!-- arrive adder -->
          <form id="form-arrives" action="/customizeArrives" method="POST" 
              class="text-center text-light p-3 bg-info" autocomplete="off" onsubmit="return validateForm()" 
              style=" border: 2px solid #f2f2f2; border-radius: 6px;">

              @csrf 
              <div class="h1"> Dodaj przejazd </div>

              <div class="lists row ml-auto mr-auto" style="border-top: 2px solid #f2f2f2;">
                  @yield('beginArriveFormPart')
                  @yield('arriveToPart')
                  @yield('trainSearcher')
                  @yield('traceSearcher')
              </div>

              <br>
              <input id="stations-request-sender" type="button" value="Zaplanuj godziny"class="btn btn-light text-dark text-light mb-2">
              <div id="stations"> </div>

              <input type="submit" id="form-sender" class="btn btn-primary mt-3" value="Dodaj przejazd" hidden/>
          </form>

        @yield('searcherScript')
    </body>
</html>