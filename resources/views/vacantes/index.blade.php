
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

    <link href="{{ asset('material') }}/css/styleManagement.css" rel="stylesheet" />
    {{-- <link href="{{ asset('material') }}/css/style-chatList.css" rel="stylesheet" /> --}}



    <!--Estilos de stylelog -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
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
        <a class="text-gray-700 navbar-brand" href="{{route('home')}}">
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


<body class="min-h-screen leading-none mt-20">
  <div id="app">


    <!--Management Vacantes-->
    <management-vacantes
    ></management-vacantes>
      

    {{-- @php
      $user = Auth::user();
      if(empty(Auth::user()->id)){
        $aux = 0;
      }
      else {
        $aux = Auth::user()->id;
      }
      @endphp
      <chat-list
      :user="{{$user}}"
      :user-id="{{$aux}}"
      ></chat-list> --}}
</div>



<script>
  //MANAGEMENT VACANTES
  document.addEventListener('DOMContentLoaded', function () {
  var modeSwitch = document.querySelector('.mode-switch');

  modeSwitch.addEventListener('click', function () {                     
    document.documentElement.classList.toggle('dark');
    modeSwitch.classList.toggle('active');
  });
  
  var listView = document.querySelector('.list-view');
  var gridView = document.querySelector('.grid-view');
  var projectsList = document.querySelector('.project-boxes');
  
  listView.addEventListener('click', function () {
    gridView.classList.remove('active');
    listView.classList.add('active');
    projectsList.classList.remove('jsGridView');
    projectsList.classList.add('jsListView');
  });
  
  gridView.addEventListener('click', function () {
    gridView.classList.add('active');
    listView.classList.remove('active');
    projectsList.classList.remove('jsListView');
    projectsList.classList.add('jsGridView');
  });
  
 //---------------------------------------------------------
 //CHAT LIST

  // document.querySelector('.chat[data-chat=person2]').classList.add('active-chat')
  // document.querySelector('.person[data-chat=person2]').classList.add('active')

  // let friends = {
  //   list: document.querySelector('ul.people'),
  //   all: document.querySelectorAll('.left .person'),
  //   name: ''
  // },
  // chat = {
  //   container: document.querySelector('.container .right'),
  //   current: null,
  //   person: null,
  //   name: document.querySelector('.container .right .top .name')
  // }

  // friends.all.forEach(f => {
  //   f.addEventListener('mousedown', () => {
  //   f.classList.contains('active') || setAciveChat(f)
  //   })
  // });

  // function setAciveChat(f) {
  //   friends.list.querySelector('.active').classList.remove('active')
  //   f.classList.add('active')
  //   chat.current = chat.container.querySelector('.active-chat')
  //   chat.person = f.getAttribute('data-chat')
  //   chat.current.classList.remove('active-chat')
  //   chat.container.querySelector('[data-chat="' + chat.person + '"]').classList.add('active-chat')
  //   friends.name = f.querySelector('.name').innerText
  //   chat.name.innerHTML = friends.name
  // }
  });
</script>
</body>
</html>