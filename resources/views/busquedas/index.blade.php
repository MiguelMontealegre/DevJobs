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


    <!--Giracards-->
    {{-- <link href="{{ asset('material') }}/css/giracards.css" rel="stylesheet" /> --}}


<style>  
  /* Agregar imagen como fondo */
  body{
  background-image: url('/material/img/categorias2.jpg');
  background-size: cover;
  background-position: top center;
  }
  
  *,
  ::before,
  ::after {
  box-sizing: border-box; /* 1 */
  border-width: 0; /* 2 */
  border-style: solid; /* 2 */
  border-color: #e5e7eb; /* 2 */
 }

  ::before,
  ::after {
  --tw-content: '';
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
            <a href="{{ route('home') }}" class="nav-link">
              <i class="material-icons">dashboard</i> {{ __('Inicio') }}
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
            <a href="{{ route('home') }}" class="nav-link">
              <i class="material-icons">dashboard</i> {{ __('Inicio') }}
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



<body class="mt-20">
  
  <span class="margenl font-bold text-3xl text-gray-700">Resultados: </span>
  <p class="margenl text-purple-500 font-bold mb-10">Hay un total de {{count($vacantes)}} Vacantes para esta busqueda</p>

  <!--Texto transparente para hacer espacio-->
  <h5 class="text-transparent">efjewfjnwfkjwe</h5>

    @foreach($vacantes as $vacante) 

    <div class="container mb-40">  
    <div class="card333 md:max-w-xl">
        <div class="front333">
          <div class="">

            <div class="flex justify-center shadow-md">
            <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                <img src="/storage/vacantes/{{ $vacante->imagen }}" alt="vacante" class="w-full h-96 md:h-auto object-cover object-center md:w-48 rounded-t-lg md:rounded-none md:rounded-l-lg">
                
              <div class="p-6 flex flex-col justify-start">
                <h5 class="mb-2 text-2xl font-bold text-teal-300">{{$vacante->titulo}}</h5>
        
                <p class="text-black font-bold">{{$vacante->categoria->nombre}}</p>
        
                <p class="block text-gray-700 font-normal my-2 mt-2">
                    Ubicación:
                    <span class="font-bold"> {{ $vacante->ubicacion->nombre }} </span>
                </p>
                <p class="block text-gray-700 font-normal my-2 ">
                    Experiencia:
                    <span class="font-bold"> {{ $vacante->experiencia->nombre }} </span>
                </p>
        
                <p class="mt-2.5 text-gray-400"> {{ Str::words(  strip_tags( $vacante->descripcion), 13, ' ...' ) }} </p>
        

                @if($vacante->activa == true)
                <p class="text-sm text-green-500">Disponible</p>
                @else
                <p class="text-sm text-red-500">No Disponible</p>
                @endif
          
                <a href="#">
                  <button class="btneon2 btneon--22 font-bold mt-4"> Salario de {{$vacante->salario->nombre}}   
                  </button>
                </a>

                <p class="text-gray-600 text-xs">{{$vacante->updated_at->diffForHumans()}}</p>
              </div>
            </div>
          </div>


        </div>
        </div>

        <div class="back333 px-3 rounded">
          <h2 class="text-xl text-center mt-10 text-gray-700 font-bold mb-3"> Conocimientos Necesarios: </h2>
          @php
            $arraySkills = explode(',', $vacante->skills)
          @endphp

          @foreach($arraySkills as $skill)
              <p class="inline-block text-gray-900 mx-auto  font-bold my-2 bordex bordex--2 px-8 py-2">
                   {{$skill}}
              </p>
          @endforeach

          <a href="{{ route('vacantes.show', ['vacante' => $vacante->id ])}}">
            <button class="btneon btneon--2 mx-auto font-bold mt-4"> Ver Vacante   
            </button>
          </a>
        </div>

      </div>


        </div>
      
      </div>
  @endforeach



</body>
</html>

