<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class LikesController extends Controller
{
       //MIddleware para Proteger de usurios que no se han registrado o iniciado sesion
       public function __construct(){
       $this->middleware('auth');
       }


  public function update(Request $request, Vacante $vacante)
  {
      // Almacena los likes de un usuario a una receta
      return auth()->user()->meGusta()->toggle($vacante);   //Este toggle sirve para: Si ya esta y lo presionan lo va a quitar , y si no esta y se presiona se va a agregar
  }

}
