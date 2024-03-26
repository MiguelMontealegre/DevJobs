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

    
    <!--Estilos light-box-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" integrity="sha512-ZKX+BvQihRJPA8CROKBhDNvoc2aDMOdAlcm7TUQY+35XYtrd3yh95QOOhsPDQY9QnKE0Wqag9y38OIgEvb88cA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--Estilos css (CDN) para "medium editor"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--Script CDN para DROPZONE -->      
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone.min.css" integrity="sha512-qkeymXyips4Xo5rbFhX+IDuWMDEmSn7Qo7KpPMmZ1BmuIA95IPVYsVZNn8n4NH/N30EY7PUZS3gTeTPoAGo1mA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  

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



<!--________________________________________-->



<body class="mt-20">


  <div id="app">

    <div class="contenedor33 col-lg-6 col-sm-12 rounded inline-block float-left">
    
      <p class="text-3xl font-bold text-gray-700 mt-8 ml-10">
        Editar Perfil <span class="font-bold text-purple-600">{{$perfil->usuario->name}}</span>
      </p>
      
  
<form 
action="{{route('perfiles.update', ['perfil' => $perfil->id])}}"
method="POST"
class="max-w-lg mx-auto my-10">
@csrf
@method('PUT')

    
    
    <!--INPUT PARA EL nombre ________________________________________________-->  
    <div class="col-10"> 
        <div class="mb-8">
             <label for="nombre" class="block mb-2 text-black">Nombre</label>
             <input id="nombre" 
             name="nombre" 
             class="py-2.5 px-3 text-sm bg-white rounded form-input w-full border border-gray-200 @error('nombre') is-invalid @enderror" 
             type="text"  
             value="{{$perfil->usuario->name}}" 
             autofocus>
        </div>
    </div>
    
        @error('nombre')
      <div class="col-7 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
         <strong class="font-bold">Error!</strong>
         <span class="block"> {{$message}}</span>
      </div>
    @enderror
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- BIOGRAFIA con la herramienta "MediumEditor"__________________________________________________________________-->
    <div class="mb-5">
        <label class="block mb-2 text-black" for="biografia"><p class="text-xl font-bold text-gray-700">
          Biografia e <span class="font-bold text-purple-600">Info</span>
      </p></label>
        <div class="medium-editor p-3 bg-white text-gray-700 rounded border border-gray-200 form-input w-full"></div>  <!--La herramienta MEDIUMEDITOR Funciona mediante un *div* por lo cual se haria con esta sintaxis masomenos -->
        <input id="biografia" type="hidden" name="biografia" value="{{$perfil->biografia}}" >
    
        
        @error('biografia')
      <div class="col-7 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
         <strong class="font-bold">Error!</strong>
         <span class="block"> {{$message}}</span>
      </div>
    @enderror
    </div>    
    
    
    
    
    
    
    
   <!-- DROPZONE Para introducir imagenes mediante "DropZone.js" ________________________________-->
   <div class="mb-5">
    <label class="block text-gray-700 mb-3" for="imagen">Imagen Vacante: </label>
  
    <div id="dropzoneDevJobs" class="dropzone bg-white text-gray-700 rounded"></div>
    <input type="hidden" name="imagen" id="imagen" value="{{$perfil->imagen}}" >
  
  @error('imagen')
    <div class="col-7 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
       <strong class="font-bold">Error!</strong>
       <span class="block"> {{$message}}</span>
    </div>
  @enderror
  <p id="error"></p>
  </div> 
  
    
    
  

    
    
    
        
        
    
        <!-- Boton para enviar los campos ____________________________________________________________________________-->
    <button type="submit" class="mx-auto btneon btneon--2 font-bold mt-5"> Actualizar perfil   
    </button>


    </form>
    
    </div>
    
    <div class="contenedor44 rounded inline-block float-left">
    
      <div class="fixed bg-white rounded">
        <img class="rounded" width="500" height="300" src="{{asset('material/img/profilex2.jpg')}}" alt="">
    
        <p class="text-2xl font-bold text-purple-600 mt-2 ml-10">
          Construye  <span class="font-bold text-sm text-gray-700"> Tu perfil a tu manera</span>
        </p>

      </div>
    
    </div>
    
  </div>
    
    
    


<!--Scripts para Hrramientas externas-->

     
     <!--Script para medium editor-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
     <!-- Script cdn para DROPZONE-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/6.0.0-beta.2/dropzone-min.js" integrity="sha512-FFyHlfr2vLvm0wwfHTNluDFFhHaorucvwbpr0sZYmxciUj3NoW1lYpveAQcx2B+MnbXbSrRasqp43ldP9BKJcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


     <!-- Configuracion adicional en script para Medium-Editor  -->
     <script> 

     Dropzone.autoDiscover = false; //Esto lo tenemos que agregar para evitar un error con dropzone

         document.addEventListener('DOMContentLoaded', () => {
    

      //Medium Editor _______________________________________________________________________________________________________
         const editor = new MediumEditor('.medium-editor', {
                toolbar : {
                    buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull',  'orderedlist', 'unorderedlist', 'h2', 'h3'],
                    static: true,
                    sticky: true
                },
                placeholder: {
                    text: 'Biografia del perfil'
                }
            });

            // Agrega al input hidden lo que el usuario escribe en medium editor
            editor.subscribe('editableInput', function(eventObj, editable) {
                const contenido = editor.getContent();
                document.querySelector('#biografia').value = contenido;
            })

            // Llena el editor con el contenido del input hidden
            editor.setContent( document.querySelector('#biografia').value ); 



            // Dropzone ____________________________________________________________________________________
            const dropzoneDevJobs = new Dropzone('#dropzoneDevJobs', {
                url: "/perfiles/imagen",
                dictDefaultMessage: 'Sube aquí tu archivo',   //Texto a mostrar
                acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",  //Aqui podemos definir que archivos acepte el dropzone
                addRemoveLinks: true,
                dictRemoveFile: 'Borrar Archivo',
                maxFiles: 1,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                //iNIT para cuadrar lo de el value('old')
                init: function() {
                    if(document.querySelector('#imagen').value.trim() ) {
                       let imagenPublicada = {};
                       imagenPublicada.size = 1234;
                       imagenPublicada.name = document.querySelector('#imagen').value;
                       
                       this.options.addedfile.call(this, imagenPublicada);
                       this.options.thumbnail.call(this, imagenPublicada, `/storage/vacantes/${imagenPublicada.name}`);

                       imagenPublicada.previewElement.classList.add('dz-sucess');
                       imagenPublicada.previewElement.classList.add('dz-complete');
                    } 
                },
                success: function(file, response) {
                    // console.log(file);
                    // console.log(response);
                    console.log(response.correcto);
                    document.querySelector('#error').textContent = '';

                    // Coloca la respuesta del servidor en el input hidden
                    document.querySelector('#imagen').value = response.correcto;

                    // Añadir al objeto de archivo el nombre del servidor
                    file.nombreServidor = response.correcto;
                },
                maxfilesexceeded: function(file) {
                    if( this.files[1] != null ) {     //En caso de subir mas de 1 archivo
                        this.removeFile(this.files[0]); // eliminar el archivo anterior
                        this.addFile(file); // Agregar el nuevo archivo 
                    }
                }, 
                removedfile: function(file, response) {
                    file.previewElement.parentNode.removeChild(file.previewElement);

                    params = {
                        imagen: file.nombreServidor ?? document.querySelector('#imagen').value
                    }           //ruta definida en ruta
                    axios.post('/vacantes/borrarimagen', params )
                        .then(respuesta => console.log(respuesta))
                }
            });   
      })

     </script> 

</body>
</html>
