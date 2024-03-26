<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Categoria;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //Obtener ultimas vacantes
        $vacanteslast = Vacante::latest()->where('activa', true)->take(6)->get();  //Y las filtramos en cuestion de que esten activas!


        //Ubicaciones para el filtrador... Poder filtrar vacantes por ubi
        $ubicaciones = Ubicacion::all();

        //Categorias para el filtrador de vacantes
        $categorias = Categoria::all();


        return view('inicio.index', compact('vacanteslast', 'ubicaciones', 'categorias'));
    }
}
