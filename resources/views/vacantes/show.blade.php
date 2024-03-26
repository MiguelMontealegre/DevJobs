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
  
    <!--Titulo animado-->
    <link href="{{ asset('material') }}/css/titulou.css" rel="stylesheet" />

   


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
  <div class="textjijo mt-20 contenedor33">
    <p class="text-gray-600">Con nosotros</p>
    <p>
      <span class="word wisteria">Edita.</span>
      <span class="word belize">Publica.</span>
      <span class="word pomegranate">Explora.</span>
      <span class="word green">Postulate.</span>
      <span class="word midnight">Contrata.</span>
    </p>
  </div>
<div id="app">  
<main class="mt-0 mb-5" style="height: 1320px;">


  <div class="contenedor33 col-lg-6 col-sm-12 pr-3 inline-block float-left" style="border-radius: 0 0 0.25rem 0.25rem;">

    
    
    
      <div class="col-12 pt-4 pl-5 rounded bg-white"> <!--app-->

      <!--Titulo-->
      <h2 class="font-bold text-gray-800">{{$vacante->titulo}}</h2>
 
  

     
      {{-- &nbsp;&nbsp; --}}
      
      <!--Imagen autor-->
      @if($perfil[0]->imagen)
      <div class="inline-block" style="vertical-align: top;">
      <a href="/storage/perfiles/{{ $perfil[0]->imagen }}" data-lightbox="imagen" data-title="Autor">
        <img src="/storage/perfiles/{{ $perfil[0]->imagen }}" alt="vacante" class="rounded-circle" style="height: 65px; width:67px;">
      </a>
      </div>
      @else
      <div class="inline-block" style="vertical-align: top;">
        <img src="/material/img/version4.png" alt="vacante" class="rounded-circle" style="height: 65px; width:67px;">
      </div>
      @endif

      <p class="text-gray-400 font-bold mt-3 ml-3"> 
        <a class="text-gray-400" href="{{route('perfiles.show',['perfil'=> $vacante->user_id ])}}">  <span class="font-bold">Autor  {{$vacante->reclutador->name}} </span>  </a>
      </p>


      <br>
       <!--Ubicacion-->
     <p class="mt-3"> 
      <a href="{{route('ubicacion.show' , ['ubicacion' => $vacante->ubicacion_id])}}"> <span class="text-gray-400 font-bold">Ubicacion {{$vacante->ubicacion->nombre}} </span> </a> 
      </p>


      <!--Salario-->
    <a href="{{route('salarios.show', ['salario' => $vacante->salario_id])}}">
     <p class="block text-purple-600 font-bold my-2">Salario de
       {{$vacante->salario->nombre}} 
     </p>
    </a> 
     
     
      <like-button vacante-id="{{$vacante->id}}"
       like="{{$like}}"
       likes="{{$likes}}">
      </like-button>
    
    

     <a href="#" class="mt-0 bg-white block lineak"><img class="icono2 inline-block" src="https://img.icons8.com/ios/50/000000/facebook--v2.png"/></a> 
   
  
<!--Categoria-->
<p class="block text-gray-700 font-bold mt-10 mb-3">Categoria: 
  <a href="{{route('categorias.show', ['categoria' => $vacante->categoria_id])}}"> <span class="font-normal"> {{$vacante->categoria->nombre}} </span> </a>
</p>


<!--Experiencia-->

<p class="block text-gray-700 font-bold my-2 mb-3">Experiencia: 
  <a href="{{route('experiencias.show', ['experiencia' => $vacante->experiencia_id])}}">
<span class="font-normal"> {{$vacante->experiencia->nombre}} </span>
</a>
</p>



<!--Descripcion-->
<div class="descripcion mt-10 mb-20 overflow-auto scrollComment">
<h4 class="descrip">Descripcion</h4>
{!! $vacante->descripcion !!}
</div>


<!--Imagen-->
<a href="/storage/vacantes/{{ $vacante->imagen }}" data-lightbox="imagen" data-title="Vacante {{$vacante->titulo}}">
<img src="/storage/vacantes/{{ $vacante->imagen }}" alt="vacante" class="w-80 mt-10 rounded">
</a>


<!--Skills-->
<div class="mb-5 overflow-auto scrollComment" style="max-height: 260px">
<h2 class="text-3xl text-center mt-10 text-gray-700 font-bold mb-3"> Conocimientos y tecnologias Necesarios: </h2>
@php
 $arraySkills = explode(',', $vacante->skills)
@endphp

@foreach($arraySkills as $skill)
   <p class="inline-block text-black font-bold my-2 bordex bordex--2 px-8 py-2 ">
        {{$skill}}
   </p>
@endforeach
</div>
    


  </div>
  </div>
  




  <div class="contenedor44 sticky bg-transparent rounded inline-block float-left" style="top: 40px;">
  
   @if($vacante->activa == true)
     
    <div class="mt-2 ml-4 card card-login card-hidden shadow-xl border">

      

      <a href="{{route('candidatos.postulacion', ['vacante' => $vacante->id])}}" class="">  <div class="card-header card-header-primary shadow text-center postu postu--2">
           <h4 class="card-title"><strong class="font-bold"> POSTULARME </strong></h4>
           <div class="social-line">
             
             <span class="material-icons">
                 perm_identity
               </span>
     
               <span class="material-icons">
                 done_all
                 </span>
     
           </div>
         </div>    </a>
             
         <div class="card-body text-center">
          
          <p class="text-sm font-bold text-green-500"> Disponible </p>


          <p class="mt-3 font-semibold text-base">
            <span class="material-icons">
              stacked_line_chart
              </span>
              {{count($candidatos)}} Postulados
            </p>  


          <p class="mt-3 font-semibold text-base">
            <span class="material-icons">
              people
              </span>
              {{$vacante->puestos}} puestos disponibles
            </p>
          


           <p class="card-description"> 

              {{-- <h4 class="descrip2 mt-3">{{$vacante->titulo}}</h4> --}}
              <!--Imagen-->
            {{-- <a href="/storage/vacantes/{{ $vacante->imagen }}" data-lightbox="imagen" data-title="Vacante {{$vacante->titulo}}">
              <img src="/storage/vacantes/{{ $vacante->imagen }}" alt="vacante" class="w-60 mx-auto mt-2.5 rounded">
            </a> --}}

            {{--CHART DE LA VACANTE--}}
            <chart-vacante
              :vistas="{{$definitiveVistas}}"
              :candidatos="{{$candidatos}}"
              :likes="{{$definitiveLikesStats}}"
              :comentarios="{{$commentsStats}}"
            ></chart-vacante>


              <!--Fecha creacion-->  
              <p class="inline-block text-gray-500 text-sm font-bold mb-1 mt-5"> 
                Publicado  {{$vacante->created_at->diffForHumans()}}    <!--La funcion "diffForHumans" Nos sirve para mejorar la fecha , antes habiamos visto la forma d ehacerlo con vue , pero solo fue un ejemplo para ver como se usaba vue, esta es una forma muy practica   -->
              </p> 
           </p>    
     
         </div>
</div>
  

@else

  
      <!--Parte derecha ... imagen -->
           
        <div class="p-6 max-w-md mx-auto bg-white rounded-xl shadow-lg flex space-x-4 border mt-10">
          <div class="shrink-0">
            <img class="h-12 w-12" src="https://img.icons8.com/cute-clipart/64/000000/warning-shield.png"/>
          </div>
          <div>
            <div class="text-xl font-medium text-black">No disponible :(</div>
            <p class=" text-red-500">El autor ha desabilitado su disponibilidad</p>
            <p class=" text-gray-500">Encuentra mas oportunidades con nuestros buscadores.</p>
          </div>
        </div>
      

@endif

  </div>
  
<!--_________________________________________________________________________________________________________-->

</main>


<div class="mt-10 bg-white col-9 mx-auto rounded">
    
  @php
    if(empty(Auth::user()->id)){
      $aux = 0;
    }
    else {
      $aux = Auth::user()->id;
    }
  @endphp

  <comment-section
    :user-id="{{$aux}}"
    :vacante-id="{{$vacante->id}}"
  ></comment-section>

  {{-- <form action="{{route('comentarios.store')}}" 
        method="post">
        @csrf>
            <label for="comentario">Deja tu comentario, Sapo perro</label>
            <input id="comentario" type="text" name="content">

            <input type="hidden" name="vacante_id" value="{{$vacante->id}}">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">

            <button type="submit" class="mx-auto btneon btneon--2 font-bold mt-5">Submit</button>
  </form> --}}


  <!--Chat-->
  {{-- <chat-advance
    :user="{{$user[0]}}"
    :user-id="{{$aux}}"
    :destiny="{{$autor[0]}}"
  ></chat-advance> --}}


</div>

</div>

<!--Titulo principal-->
<script src="{{ asset('material')}}/js/titulou.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>