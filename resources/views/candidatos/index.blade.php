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
    <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!--estilo owl-carousel-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <!--Estilos light-box-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<style>  
  /* Agregar imagen como fondo */
  body{
  background-image: url('/material/img/categorias2.jpg');
  background-size: cover;
  background-position: top center;
  }

</style>

</head>


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
            <a href="{{route('home')}}" class="nav-link">
              <i class="material-icons">dashboard</i> Inicio
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{route('notificaciones')}}" class="nav-link">
              <i class="material-icons">notifications_none</i> {{ Auth::user()->unreadNotifications->count() }}
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
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




<body>


<h1 class="mt-20 ml-20 text-2xl text-purple-600 font-bold">Candidatos para</h1>

<h1 class="text-3xl text-center mt-5 font-bold">Vacante: {{$vacante->titulo}}</h1>




@if(count($vacante->candidatos) > 0)

 <div class="owl-carousel owl-theme"> 

@foreach($vacante->candidatos as $key => $candidato)

<div class="blog-card spring-fever rounded mt-4">
  <p class="text-white font-bold">{{$key+1}}</p>
  <div class="title-content">
    <h3>Hi my name is {{ Str::words(  strip_tags( $candidato->nombre), 2, ' ...' ) }} 
      <p class="text-sm iconcall">{{ Str::words(  strip_tags( $candidato->edad), 1, ' ...' ) }}  Años</p>
    </h3>
    <div class="intro"> I'm {{ Str::words(  strip_tags( $candidato->profesion), 15, ' ...' ) }} 
    </div>
  </div>

  <div class="card-info overflow-auto">

    <div class="scrollP overflow-auto" style="max-height: 140px;">
    <p class="font-bold text-teal-500 mt-3">Why i deserve this work?</p> 
    {!! $candidato->descripcion !!} 
  </div>
    
    <a class="licon" href="/storage/cv/{{$candidato->cv}}"> <img width="14" class="inline-block" src="https://img.icons8.com/fluency/48/000000/pdf-2.png"/>Curriculum</a>
  </div>


  <div class="utility-info">
    <ul class="utility-list">
      <li><span class="licon icon-tag"></span>{{$candidato->email}}</li>
      <li><span class="material-icons iconcall">call</span>{{$candidato->telefono}}</li>
      {{-- <li><span class="licon icon-like"></span><a href="#">2</a></li> --}}
      <li><span class="licon icon-dat"></span>{{$candidato->created_at->diffForHumans()}}</li>
      
    </ul>
  </div>
  <div class="gradient-overlay"></div>
  <div class="color-overlay"></div>
</div>

@endforeach
 </div>  


<!--Div vacio tactico por cuestiones de maquetacion -->
 <div class="holaa"></div>




@else
<div class="mb-10 p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex items-center space-x-4 border mt-10">
    <div class="shrink-0">
      <img class="h-12 w-12" src="https://img.icons8.com/cute-clipart/64/000000/warning-shield.png"/>
    </div>
    <div>
      <div class="text-xl font-medium text-black">OYEME MASTER</div>
      <p class=" text-red-400">Aun no tienes Candidatos para esta vacante!</p>
    </div>
  </div> 
@endif



</body>
</html>
