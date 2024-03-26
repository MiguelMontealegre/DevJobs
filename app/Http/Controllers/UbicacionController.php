<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{

    public function show(Ubicacion $ubicacion)
    {
        //Aqui obtenemos las vacantes que pertenecen a la categoria que selecionamos en el menu
        $vacantes = Vacante::where('ubicacion_id', $ubicacion->id)->paginate(8);

        return view('ubicacion.show', compact('vacantes', 'ubicacion'));
    }
    
}
