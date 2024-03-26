<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class LikesCommentController extends Controller
{
    
     
       //MIddleware para Proteger de usurios que no se han registrado o iniciado sesion
       public function __construct(){
       $this->middleware('auth');
       }
  

  public function update(Request $request, Comentario $comentario)
  {
      // Almacena los likes de un usuario a una receta
      return auth()->user()->meGustaComment()->toggle($comentario);   //Este toggle sirve para: Si ya esta y lo presionan lo va a quitar , y si no esta y se presiona se va a agregar
  }
  
}
