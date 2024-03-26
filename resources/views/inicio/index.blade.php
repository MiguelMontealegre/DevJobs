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



<style>
  /* Agregar imagen como fondo */
  body{
  background-image: url('/material/img/categorias2.jpg');
  background-size: cover;
  background-position: top center; */
  /* background-color: rgba(253, 253, 233, 0.966);*/
  }
  /* .backgroundIni:before{
  content: "";
  width: 100%;
  height: 100%;
  position: absolute;
  z-index: -1;
  left: 0;
  top: 0;
  background-image: url('/material/img/categorias2.jpg');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  filter: blur(50px);
  opacity: 0.7;
  } */

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
            <a href="{{route('vacantes.index')}}" class="nav-link">
              <i class="material-icons">dashboard</i> Mis Vacantes
            </a>
          </li>

          <li class="nav-item">
            <a href="{{route('notificaciones')}}" class="nav-link">
              {{-- <notifications></notifications> --}}
              <i class="material-icons">notifications_none</i> {{ Auth::user()->unreadNotifications->count() }}
            </a>
          </li>

          {{-- <div id="app">
            <notifications-component></notifications-component>
          </div> --}}

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



<body>
<div class="backgroundIni">


  <div class="hero mt-20">
    <nav class="container">
       @include('ui.categorias')
    </nav>
  </div>


<div class="lg:mt-3 xs:mt-40 flex flex-col lg:flex-row shadow bg-white bbox relative">
  <div class="lg:w-1/2 px-8 lg:px-12 py-12 lg:py-24 bbox">
      <p class="text-2xl text-gray-700">
          Dev<span class="font-bold">Jobs</span>
      </p>

      <h1 class="mt-2 sm:mt-4 text-2xl font-bold  text-gray-700 leading-tight">
          Encuentra un trabajo remoto o en tu país
          <span class="text-teal-400 block">Para Desarrolladores / Diseñadores Web</span>
      </h1>

      <!--BUSCADOR-->
      <div class="mt-10">
        <form action="{{ route('buscar.show') }}" class="container h-100">
             <div class="row h-100">
                <div class="col-md-6">


                  <span class="material-icons text-purple-600 inline-block z-0">
                    travel_explore
                  </span>


                  <p class="text-purple-600 text-xl inline-block z-0">Busca tu trabajo ideal </p>

                   <input type="search" name="buscar" class="inline-block form-control z-0" placeholder="Buscar vacante">

                </div>
             </div>
        </form>
    </div>

    </div>


    <!--Parte derecha ... imagen -->
    <div class="block lg:w-1/2">
        <img class="inset-0 h-full w-full object-cover object-center rounded" src="{{ asset('material/img/4321.jpg')}}" alt="devjobs">
    </div>
</div>





<!--Mostrar las vacantes mas recientes _____________________________________________________-->


<div class="mt-20 flex flex-col lg:flex-row shadow bg-white bbox">
  <div class="lg:w-1/2 px-8 lg:px-12 py-12 lg:py-24 bbox">
      <p class="text-2xl text-purple-600">
          Nuevas<span class="font-bold">Vacantes</span>
      </p>

      <h1 class="mt-2 sm:mt-4 text-2xl font-bold  text-gray-700 leading-tight">
          Encuentra aqui las vacantes mas recientes disponibles
          <span class="text-teal-400">Oportunidades ideales!!</span>
      </h1>



      @include('ui.filtrar')
    </div>


    <!--Parte derecha ... imagen -->
    <div class="block lg:w-1/2 mx-auto bbox">

      <div class="owl-carousel owl-theme bbox" style="margin-left: 20%;">
        @foreach($vacanteslast as $vacante)
            <div class="blog-card2 spring-fever rounded mt-0 bbox">
                <div class="title-content bbox">
                <h3>Vacante de {{ Str::words(  strip_tags( $vacante->titulo), 2, ' ...' ) }}
                    <p class="text-sm iconcall">Categoria {{$vacante->categoria->nombre}}</p>
                </h3>
                <div class="intro text-black font-bold bbox"> Salario de
                    {{$vacante->salario->nombre}} brindado por la compañia
                </div>
                </div>
                <div class="card-info bbox">
                <p class="font-bold text-teal-500 mt-3">Detalles</p>
                {{ Str::words(  strip_tags( $vacante->descripcion), 13, ' ...' ) }}
                <button class="mx-auto btneon btneon--2 font-bold mt-3" onclick="window.location.href='{{ route('vacantes.show', ['vacante' => $vacante->id ])}}'">Ver vacante</button>
                </div>
                <div class="utility-info bbox">
                <ul class="utility-list">
                    <li><span class="material-icons iconcall">person_pin</span>Autor {{$vacante->reclutador->name}}</li>
                    <li><span class="licon icon-like"></span>{{ count( $vacante->likes)}}</li>
                    <li><span class="licon icon-dat"></span>{{$vacante->created_at->diffForHumans()}}</li>
                    <li><span class="material-icons text-red-700">
                    push_pin
                    </span>{{$vacante->ubicacion->nombre}}</li>

                </ul>
                </div>
                <div class="gradient-overlay"></div>
                <div class="color-overlay"></div>
            </div>
        @endforeach
</div>
</div>
</div>


<!--MENU DE PAISES MAS DESTACADOS-->
<div class="text-center mt-8">
<h1 class="titlejojo text-purple-600 mt-10">Ubicaciones ideales</h1><br>
<h1 class="mt-2 sm:mt-4 text-2xl font-bold  text-gray-700 leading-tight">
  Encuentra aqui los paises mas destacados en cuanto a calidad y cantidad de vacantes
</h1>
</div>
<div id="app22" class="containeroo mb-40">
 <a href="{{route('ubicacion.show', ['ubicacion' => 2 ])}}"> <card data-image="https://images.unsplash.com/photo-1479660656269-197ebb83b540?dpr=2&auto=compress,format&fit=crop&w=1199&h=798&q=80&cs=tinysrgb&crop=">
    <h1 class="titleprr" slot="headeroo">EEUU</h1>
    <p class="prr" slot="contentoo">Un pais muy desarrollado y perfecto para vivir con sus lugares magicos e infinidad de experiencias por vivir... Generalmente Se percibe un muy buen sueldo y muy buenas condiciones de trabajo...</p>
  </card> </a>
  <a href="{{route('ubicacion.show', ['ubicacion' => 4 ])}}"> <card data-image="https://images.unsplash.com/photo-1479659929431-4342107adfc1?dpr=2&auto=compress,format&fit=crop&w=1199&h=799&q=80&cs=tinysrgb&crop=">
    <h1 class="titleprr" slot="headeroo">Mexico</h1>
    <p class="prr" slot="contentoo">Con su vibra latina en su esplendor , Ciudades llenas de vida y lugares turisticos perfectos, Mexico como uno de los lugares mas privilegiados...</p>
  </card> </a>
  <a href="{{route('ubicacion.show', ['ubicacion' => 3 ])}}"> <card data-image="https://images.unsplash.com/photo-1479644025832-60dabb8be2a1?dpr=2&auto=compress,format&fit=crop&w=1199&h=799&q=80&cs=tinysrgb&crop=">
    <h1 class="titleprr" slot="headeroo">Canada</h1>
    <p class="prr" slot="contentoo">Uno de los mejores paises para vivir, Con muy buen sueldo promedio para programadores Gracias a su desarrollada economia y administracion de gobernnates...</p>
  </card>  </a>
  <a href="{{route('ubicacion.show', ['ubicacion' => 12 ])}}"> <card data-image="https://images.unsplash.com/photo-1479621051492-5a6f9bd9e51a?dpr=2&auto=compress,format&fit=crop&w=1199&h=811&q=80&cs=tinysrgb&crop=">
    <h1 class="titleprr" slot="headeroo">China</h1>
    <p class="prr" slot="contentoo">Un pais lleno de cultura y la amabilidad y carisma de su gente lo hace uno de los mejores , Se percibe un muy buen nivel en su comunidad de desarrolladores y un muy buen sueldo promedio</p>
  </card> </a>
</div>




<!--Scripts de cards animadas-->
<script src='https://cdnjs.cloudflare.com/ajax/libs/vue/2.0.1/vue.min.js'></script>
<script  src="{{ asset('material') }}/js/script.js"></script>

</div>
</body>
</html>
