<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    
    public function show(Categoria $categoria)
    {

        //Aqui obtenemos las vacantes que pertenecen a la categoria que selecionamos en el menu
        $vacantes = Vacante::where('categoria_id', $categoria->id)->paginate(8);

        return view('categorias.show', compact('vacantes', 'categoria'));
    }
    
    




}
