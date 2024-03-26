<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use App\Models\Vacante;
use Illuminate\Http\Request;

class ExperienciaController extends Controller
{
    public function show(Experiencia $experiencia){

        $vacantes = Vacante::where('experiencia_id' , $experiencia->id)->paginate(8);

        return view('experiencia.show', compact('vacantes' , 'experiencia'));
    }
}
