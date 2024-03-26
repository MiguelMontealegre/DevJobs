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

    <!--Estilos de app-->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luxurious+Roman&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!--Estilos de stylelog -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!--estilo owl-carousel-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!--Estilos light-box-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <!--Cards animadas para clasificacion de paises-->
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('material') }}/css/style.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Playfair+Display:700|Raleway:500.700'>



    

@yield('styles')
    <style>  
        /* Agregar imagen como fondo */
        body{
        background-image: url('/material/img/categorias2.jpg');
        background-size: cover;
        background-position: top center;
        }
      </style>
      

</head>


<body>
<div id="app">
<!--Nav en caso de login-->
@auth()
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="text-gray-700 navbar-brand" href="#">
            <span class="font-bold text-3xl text-gray-700">Devjobs </span></a>

            <a class="ml-0" href="#"><br>
              <span class="text-white activo2 text-sm">By MiguelMontealegre </span></a>
      </div>

      
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a href="{{route('vacantes.index')}}" class="nav-link">
              <i class="material-icons">dashboard</i> Mis Vacantes
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('notificaciones')}}" class="nav-link">
              <i class="material-icons">notifications_none</i> {{ Auth::user()->unreadNotifications->count() }}
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('perfiles.show' , ['perfil'=>Auth::user()->id]) }}" class="nav-link">
              <i class="material-icons">face</i> {{ Auth::user()->name }}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <!--Icono-->
              <span class="material-icons">
                logout
              </span>
                  <!--texto-->
                  Logout
              </a>
          </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
            </form>

        </ul>
      </div>
    </div>
  </nav>
@endauth


<!--Nav esin login -->
@guest()        
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
      <div class="navbar-wrapper">
        <a class="text-gray-700 navbar-brand" href="#">
            <span class="font-bold text-3xl text-gray-700">Devjobs </span></a>
            <a class="ml-0" href="#"><br>
              <span class="text-white activo2 text-sm">By MiguelMontealegre </span></a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="sr-only">Toggle navigation</span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
        <span class="navbar-toggler-icon icon-bar"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{route('vacantes.index')}}" class="nav-link">
              <i class="material-icons">dashboard</i> Mis Vacantes
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('register') }}" class="nav-link">
              <i class="material-icons">person_add</i> {{ __('Register') }}
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">
              <i class="material-icons">fingerprint</i> {{ __('Login') }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  @endguest


<!--________________________________________-->



        <main>
            @yield('content')
        </main>


        
</div>
   @yield('scripts')

</body>
</html>
