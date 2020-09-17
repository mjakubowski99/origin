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
<body>
    <div id="app">
        <div id="page-content-wrapper" class="container-fluid">

            <sidebar-component user-name="{{ Auth::user()->name }}" user-email="{{ Auth::user()->email }}" photo-link="{{asset('storage/profileImage.jpg')}}"> </sidebar-component>
            
            <div id="page-content">
                  <navbar-component main-href="{{url('/')}}" home-href="{{url('home')}}"> </navbar-component>

                  <div id="page-content-text">
                    <button id="sidebar-collapse" class="btn btn-primary mt-5"> Sprawdź profil </button>
                    <div id="cards" class="mt-2 ml-5 row">
                        <card-component photo-link="{{asset('storage/train-card-1.jpg')}}" card-text="Zobacz swoje bilety!" 
                                        button-text="Moje bilety" href-link="{{route('home')}}" > 
                        </card-component>

                        <card-component photo-link="{{asset('storage/train-card-2.jpg')}}" card-text="Kup bilet i jedź gdzie tylko chcesz!" 
                                        button-text="Kup bilet" href-link="{{route('buyTicket')}}" > 
                        </card-component>

                        <card-component photo-link="{{asset('storage/train-card-3.jpg')}}" card-text="Odwiedź nas na facebooku!" 
                                        button-text="Wbijaj" href-link="{{route('home')}}" > 
                        </card-component>
                    </div>      
                 </div>
             </div>
        </div>
    </div>
</body>

<script> 

  window.addEventListener('DOMContentLoaded', (event) => {
    const btn = document.getElementById('sidebar-collapse');
    const close = document.getElementById('close-button');
    const sidebar = document.getElementById('sidebar');
    const pageContent = document.getElementById('page-content-text');
    const page = document.getElementById('page-content');

    btn.addEventListener('click', ()=>{
        sidebar.style.display = "flex";
        sidebar.style.flex = 10;
        pageContent.style.display = "none";
        page.style.opacity = "10%";
    });

    close.addEventListener('click', ()=>{
      sidebar.style.display = "none";
      pageContent.style.display = "block";
      page.style.opacity = "100%";
    });
  });
</script>
</html>