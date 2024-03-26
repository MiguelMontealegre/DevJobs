<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
 

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orelega+One&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luxurious+Roman&display=swap" rel="stylesheet">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!--icons-->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />

    <!--Estilos css (CDN) para "medium editor"-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/css/medium-editor.min.css" integrity="sha512-zYqhQjtcNMt8/h4RJallhYRev/et7+k/HDyry20li5fWSJYSExP9O07Ung28MUuXDneIFg0f2/U3HJZWsTNAiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    

<style>  
  /* Agregar imagen como fondo */
  body{
  background-image: url('/material/img/oficina2.jpg');
  background-size: cover;
  background-position: top center;
  }

  .inputo{
  max-width: 45%;
  display: inline-block;
   }

  .inputo2{
   max-width: 27%;
   display: inline-block;
   }
   .inputo3{
   max-width: 34%;
   display: inline-block;
   }

   .icono2{
   width: 52px;
   height: 52px;
   }

  .icono3{
  width: 52px;
  height: 52px;
  }

  .bggg{
     background: #8e24aa;
  }
</style>

</head>





<body>

  @if(session('estado'))
     <div class="bggg p-8 text-center text-white font-bold uppercase">
         {{session('estado')}}
     </div>
  @endif


    <div class="col-lg-6 col-md-8 col-sm-10 ml-auto mr-auto">

<div class="my-5 card card-login card-hidden">
    <div class="card-header card-header-primary text-center">
      <h4 class="card-title font-weight-bold"><strong> Para que te contacten </strong></h4>
      <div class="social-line">
        
        <span class="material-icons">
            perm_identity
          </span>

          <span class="material-icons">
            folder_shared
            </span>

      </div>
    </div>

 

    <div class="card-body text-center">
          
            <form enctype="multipart/form-data" class="d-inline" method="POST" action="{{ route('candidatos.store') }}">

              @csrf

              <!--Grupo de 2 inputs , Nombre y edad -->
                <div class="input-group">
                  <img class="icono2" src="https://img.icons8.com/color/48/000000/name--v2.png"/>
                  <input id="nombre" type="text" name="nombre" class="form-control inputo" placeholder="Nombre" required autofocus value="{{old('nombre')}}" >  
                    <div class="input-group-addon">
                      <img class="ml-4 icono3" src="https://img.icons8.com/cute-clipart/64/000000/elderly-person.png"/>
                      <input id="edad" type="text" name="edad"  class="form-control inputo2" placeholder="Edad" required value="{{old('edad')}}" >  
                    </div>
                  </div>
                  @error('nombre')
                    <div class="col-5 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
                      <strong class="font-bold">Error!</strong>
                      <span class="block"> {{$message}}</span>
                    </div>
                    @enderror
                    @error('edad')
                    <div class="col-5 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
                      <strong class="font-bold">Error!</strong>
                      <span class="block"> {{$message}}</span>
                    </div>
                    @enderror

                
                <!--Email-->
                <div class="input-group mt-3">
                    <div class="input-group-prepend">
                      <img class="icono3 mr-2" src="https://img.icons8.com/external-inipagistudio-lineal-color-inipagistudio/64/000000/external-email-operation-management-inipagistudio-lineal-color-inipagistudio.png"/>
                    </div>
                    <input id="email" type="email" name="email"  class="form-control inputo" placeholder="{{ __('Email...') }}" required value="{{old('email')}}" >  
                  </div>
                  @error('email')
                    <div class="col-5 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
                      <strong class="font-bold">Error!</strong>
                      <span class="block"> {{$message}}</span>
                    </div>
                    @enderror



                  <!--Telefono y profesion-->
                  <div class="input-group mt-4">
                    <img class="icono3" src="https://img.icons8.com/nolan/64/submit-resume.png"/>
                    <input id="profesion" type="text" name="profesion" class="form-control inputo" placeholder="Profesion" required value="{{old('profesion')}}" >  
                      <div class="input-group-addon">
                          <img class="ml-4 icono3" src="https://img.icons8.com/external-icongeek26-outline-gradient-icongeek26/64/000000/external-phone-essentials-icongeek26-outline-gradient-icongeek26.png"/>
                          <input id="telefono" type="text" name="telefono"  class="form-control inputo3" placeholder="Telefono" required value="{{old('telefono')}}" >  
                      </div>
                    </div>

                    @error('profesion')
                    <div class="col-5 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
                      <strong class="font-bold">Error!</strong>
                      <span class="block"> {{$message}}</span>
                    </div>
                    @enderror
                    @error('telefono')
                    <div class="col-5 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
                      <strong class="font-bold">Error!</strong>
                      <span class="block"> {{$message}}</span>
                    </div>
                    @enderror

                    
                <!--Descripcion-->
                <img class="icono3 mr-2" src="https://img.icons8.com/external-inipagistudio-lineal-color-inipagistudio/64/000000/external-email-operation-management-inipagistudio-lineal-color-inipagistudio.png"/>                
                <div class="medium-editor p-3 bg-white text-gray-700 rounded border border-gray-200 form-input w-full overflow-auto" style="max-height: 250px;"></div>  
                <input id="descripcion" type="hidden" class="form-control inputo" name="descripcion" value="{{old('descripcion')}}">

                @error('descripcion')
                    <div class="col-5 ml-3 text-sm mt-1 bg-red-100 border border-red-400 text-red-700 px-3 py-1 rounded relative mb-6" role="alert">
                      <strong class="font-bold">Error!</strong>
                      <span class="block"> {{$message}}</span>
                    </div>
                @enderror



                  <!--PDF Hoja de vida-->
                <div class="input-group mt-5">
                  <div class="input-group-prepend">
                    <img class="icono3" src="https://img.icons8.com/external-bearicons-gradient-bearicons/64/000000/external-email-approved-and-rejected-bearicons-gradient-bearicons.png"/>
                  </div>
                  <label for="cv">Curriculum (PDF)</label>  
                  <input type="file" name="cv"  class="ml-3 form-control" required
                  accept="application/pdf">  <!--Con este atributo "accept" estamos validando que solo sea "PDF"-->
                </div>

                <!--Input hidden para que tambien se envie el id de la vacante-->
                 <input type="hidden" name="vacante_id" value="{{$vacante->id}}"> 

                 
                 
                <br>
                <button type="submit" class="btn btn-outline-success"> Enviar <span class="material-icons">
                    touch_app
                    </span>  </button>

            </form>

    </div>
</div>
</div>


<!--Scripts para Hrramientas externas-->

     <!--Script para medium editor-->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/medium-editor/5.23.3/js/medium-editor.min.js" integrity="sha512-5D/0tAVbq1D3ZAzbxOnvpLt7Jl/n8m/YGASscHTNYsBvTcJnrYNiDIJm6We0RPJCpFJWowOPNz9ZJx7Ei+yFiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     

     <!-- Configuracion adicional en script para Medium-Editor  -->
     <script> 


      //Cuando el app este montada
      document.addEventListener('DOMContentLoaded', () => {
    
      //Medium Editor _______________________________________________________________________________________________________
         const editor = new MediumEditor('.medium-editor', {
                toolbar : {
                    buttons: ['bold', 'italic', 'underline', 'quote', 'anchor', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull',  'orderedlist', 'unorderedlist', 'h2', 'h3'],
                    static: true,
                    sticky: true
                },
                placeholder: {
                    text: 'Aptitudes o ¿por que mereces este trabajo?'
                }
            });

            // Agrega al input hidden lo que el usuario escribe en medium editor
            editor.subscribe('editableInput', function(eventObj, editable) {
                const contenido = editor.getContent();
                document.querySelector('#descripcion').value = contenido;
            })

            // Llena el editor con el contenido del input hidden
            editor.setContent( document.querySelector('#descripcion').value ); 



            
            })

     </script> 

</body>
</html>

  
