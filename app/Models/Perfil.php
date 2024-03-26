<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    

    //Relacion 1:1 perfil a usuario
    public function usuario(){
        return $this->belongsTo(User::class , 'user_id');
    }
    //'belongsTo' se declara en el modelo que contiene  la llave foranea,
    // De esta forma se puede decir que un registro le pertenece al dato al que apunta
    // su llave foranea
}
