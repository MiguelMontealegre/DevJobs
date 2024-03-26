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
  background-image: url('/material/img/notis.jpg');
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
        <a class="text-gray-700 navbar-brand ml-0" href="#">
            <span class="font-bold text-3xl text-gray-700 ml-0">Todas las Notificaciones </span></a>
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




<!--________________________________________-->


<body>

<a href="{{route('notificaciones')}}">  <button class="mt-20 ml-20 px-5 py-2 text-sm text-purple-600 font-semibold rounded-full border border-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2"><span class="material-icons">
  explore
  </span>
  Ver notificaciones nuevas</button>  </a>





@if(count($notificaciones) > 0)

<div class="mt-0 flex flex-col lg:flex-row shadow">
  <div class="lg:w-1/2 px-8 lg:px-12 py-5 lg:py-24">
      <p class="text-3xl text-gray-800">
          Dev<span class="font-bold">Jobs</span>
      </p>

      <h1 class="mt-2 sm:mt-4 text-3xl font-bold text-white leading-tight">
          La mejor forma de administrar los aspirantes a tu empresa
          <span class="text-teal-500 block">Para Reclutadores / Empresas</span>
      </h1>


      <img src="{{asset('material/img/notiimg.jpg')}}" class="rounded" width="230" height="230" alt="">

    </div>


    <!--Parte derecha ... imagen -->
    <div class="block lg:w-1/2">
            
      <h1 class="ml-20 mt-20 text-2xl text-white font-bold">Total de {{count($notificaciones)}} notificaciones de candidatos</h1>

  <div class="owl-carousel owl-theme">   
@foreach($notificaciones as $key => $notificacion)

   @php
       $data = $notificacion->data     //Data se usa para acceder a el campo de "data" en nuestra tabla de notificaciones en la DB, alli se encontraran datos especificos que hayamos puesto en el proceso de notificaciones
   @endphp


   <div class="border mt-4 mb-10 py-8 px-8 max-w-sm ml-20 rounded-xl shadow-md space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
    <p class="text-white">{{$key+1}}</p>
  <img class="block mx-auto col-lg-4 col-sm-5" style="height: 80px;" src="https://img.icons8.com/nolan/64/checklist.png"/> 
  <div class="text-center space-y-2.5 sm:text-left">
    <div class="space-y-2.5">
      <p class="text-lg text-white font-semibold"> <span>Para: </span>
        {{$data['vacante']}}
      </p>
      <p class="text-slate-500 mt-10 text-sm my-3">
        Se postulo {{$notificacion->created_at->diffForHumans()}}   </p>
    
     <br>
    </div>
    <a href="{{route('candidatos.index', ['id' => $data['id_vacante']])}}">  <button class="px-4 text-sm text-purple-600 font-semibold rounded-full  btneon2 btneon--22">Ver todos los candidatos</button>
    </a>
    
  </div>
</div>
    
@endforeach
  </div>

@else


  <div class="mt-20 flex flex-col lg:flex-row shadow">
    <div class="lg:w-1/2 px-8 lg:px-12 py-12 lg:py-24">
        <p class="text-3xl text-gray-700">
            Dev<span class="font-bold">Jobs</span>
        </p>
  
        <h1 class="mt-2 sm:mt-4 text-3xl font-bold  text-white leading-tight">
            La mejor forma de administrar los aspirantes a tu empresa
            <span class="text-teal-500 block">Para Reclutadores / Empresas</span>
        </h1>
      </div>
  
  
      <!--Parte derecha ... imagen -->
      <div class="block lg:w-1/2">
              
        <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-lg flex space-x-4 border mt-10">
          <div class="shrink-0">
            <img class="h-12 w-12" src="https://img.icons8.com/cute-clipart/64/000000/warning-shield.png"/>
          </div>
          <div>
            <div class="text-xl font-medium text-black">OYEME MAQUINA</div>
            <p class=" text-red-400">Aun no tienes notificaciones!</p>
          </div>
        </div>


@endif



    </div>
</div>
    


</body>
</html>