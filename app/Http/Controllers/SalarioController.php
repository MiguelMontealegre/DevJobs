<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use App\Models\Vacante;
use Illuminate\Http\Request;

class SalarioController extends Controller
{
    public function show(Salario $salario){

        $vacantes = Vacante::where('salario_id' , $salario->id)->paginate(8);

        return view('salarios.show' , compact('vacantes' , 'salario'));
    }
}
