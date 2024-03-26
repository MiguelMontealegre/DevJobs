<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




//Todas las rutas que esten en este grupo deben estar autenticadas y verificadas por parte del usuario
Route::group(['middleware' => ['auth', 'verified']], function(){

    Route::get('/vacantes', '\App\Http\Controllers\VacanteController@index')->name('vacantes.index');  //Vista de vacantes
    Route::get('/vacantesIndex', '\App\Http\Controllers\VacanteController@index2')->name('vacantes.index2');  //Vista de vacantes
    Route::get('/vacantes/create', '\App\Http\Controllers\VacanteController@create')->name('vacantes.create');  //Creacion de vacantes
    Route::post('/vacantes', '\App\Http\Controllers\VacanteController@store')->name('vacantes.store');   //Guardar vacantes
    Route::get('/vacantes/{vacante}/edit', '\App\Http\Controllers\VacanteController@edit')->name('vacantes.edit');   //Edtar vacantes
    Route::put('/vacantes/{vacante}' , '\App\Http\Controllers\VacanteController@update')->name('vacantes.update');   //Actualizar como tal la vacante 
    Route::delete('/vacantesEli/{vacante}' , '\App\Http\Controllers\VacanteController@destroy')->name('vacantes.destroy');  //Eliminar vacantes

    
    Route::post('/vacantes/imagen', '\App\Http\Controllers\VacanteController@imagen')->name('vacantes.imagen');  //RUTA PARA PODER SUBIR IMAGENES A EL DROPZONE !!!
    Route::post('/vacantes/borrarimagen', '\App\Http\Controllers\VacanteController@borrarimagen')->name('vacantes.borrar');  //RUTA PARA ELIMINAR IMAGENES DEL DROPZONE EN CASO DE ERROR


    //NOTIFICACIONES
    Route::get('/notificaciones', '\App\Http\Controllers\NotificacionesController')->name('notificaciones'); 
    Route::get('/notificacionesAll', '\App\Http\Controllers\AllNotifications')->name('notificacionesAll'); 


    //Vista de candidatos
    Route::get('/candidatoss/{id}', '\App\Http\Controllers\CandidatoController@index')->name('candidatos.index'); 


    //Cambiar estado de la vacante activa-inactiva
    Route::post('/vacantesEstado/{vacante}', '\App\Http\Controllers\VacanteController@estado')->name('vacantes.estado');  

    //likes
    Route::post('/vacanteslikes/{vacante}', '\App\Http\Controllers\LikesController@update')->name('likes.update');
   
      
    //Perfiles editar
    Route::get('/perfiles/{perfil}/edit', '\App\Http\Controllers\PerfilController@edit')->name('perfiles.edit'); 
    Route::put('/perfiles/{perfil}' , '\App\Http\Controllers\PerfilController@update')->name('perfiles.update');  
    Route::post('/perfiles/imagen', '\App\Http\Controllers\PerfilController@imagen')->name('perfiles.imagen');  //RUTA PARA PODER SUBIR IMAGENES A EL DROPZONE !!!
    Route::post('/perfiles/borrarimagen', '\App\Http\Controllers\PerfilController@borrarimagen')->name('perfiles.borrar');  //RUTA PARA ELIMINAR IMAGENES DEL DROPZONE EN CASO DE ERROR


    //COMENTARIOS
    Route::post('/comentarios/store', '\App\Http\Controllers\ComentarioController@store')->name('comentarios.store'); 
    Route::post('/comentarios2/store', '\App\Http\Controllers\ComentarioController@store2')->name('comentarios2.store');
    Route::delete('/comentariosEli/{comentario}' , '\App\Http\Controllers\ComentarioController@destroy')->name('comentarios.destroy');  //Eliminar vacantes

    
    //Like comentario
    Route::post('/comentarioslikes/{comentario}', '\App\Http\Controllers\LikesCommentController@update')->name('likesComm.update');
});


//Rutas publicas 

    Route::get('/test', '\App\Http\Controllers\VacanteController@test');

    //PAGINA DE INICIO
    Route::get('/', '\App\Http\Controllers\InicioController')->name('home');
 

     //Perfiles show
     Route::get('/perfiles/{perfil}', '\App\Http\Controllers\PerfilController@show')->name('perfiles.show');


    //Apartado de categorias en el inicio
    Route::get('/categorias/{categoria}', '\App\Http\Controllers\CategoriaController@show')->name('categorias.show');


    //Demas caracteristicas de clasificacion
    Route::get('/salarios/{salario}', '\App\Http\Controllers\SalarioController@show')->name('salarios.show');  //Salarios
    Route::get('/experiencia/{experiencia}', '\App\Http\Controllers\ExperienciaController@show')->name('experiencias.show');  //Experiencia




    //Apartado de ubicaciones en el inicio
    Route::get('/ubicaciones/{ubicacion}', '\App\Http\Controllers\UbicacionController@show')->name('ubicacion.show');


    //Mandar datos al reclutador
    Route::get('/candidatos/{vacante}', '\App\Http\Controllers\VacanteController@postulacion')->name('candidatos.postulacion');  //Creacion de postulacion
    Route::post('/candidatos/store', '\App\Http\Controllers\CandidatoController@store')->name('candidatos.store');   //Guardar vacantes



    //BUSCADOR
    Route::get('/buscar', '\App\Http\Controllers\VacanteController@search')->name('buscar.show');


    //Filtrar
    Route::post('/busqueda/buscar', '\App\Http\Controllers\VacanteController@filtrar')->name('vacantes.filtrar');
    

    
    //Mostrar vacante
    Route::get('/vacantes/{vacante}', '\App\Http\Controllers\VacanteController@show')->name('vacantes.show');   //Muestra vacante con su info sin necesidad de autenticacion

    //COMENTARIOS
    Route::get('/comentarios', '\App\Http\Controllers\ComentarioController@index')->name('comentarios.index');


    Auth::routes( ['verify' => true]);    //2° Paso para verificacion de email a el momento de registro

