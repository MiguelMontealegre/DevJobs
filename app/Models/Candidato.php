<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{
    protected $fillable =[
       'nombre', 'edad', 'email', 'profesion', 'telefono','descripcion' , 'cv', 'vacante_id'
    ];

    
}
