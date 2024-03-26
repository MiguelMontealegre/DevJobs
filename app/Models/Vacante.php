<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{

    //RECORDAR QUE PARA QUE SE UARDEN LOS CAMPOS EN LA DB TENEMOS QUE HACER ESTE FILLABLE Y TAMBIEN LA REL EN EL User model
    protected $fillable = [
        'titulo',
        'imagen',
        'descripcion',
        'puestos',
        'skills',
        'categoria_id',
        'experiencia_id',
        'ubicacion_id',
        'salario_id',
    ];



    //Relacion de vacante con la categoria de la vacante (Para poder mostrar en la vista el nombre de la categoria)    1:1
    public function categoria(){
        return
        $this -> belongsTo(Categoria::class);
    }


    //Relacion de vacante con el salario (Para poder mostrar en la vista la cantd de dinero)    1:1
    public function salario(){
        return
        $this -> belongsTo(Salario::class);
    }


    //Relacion de vacante con la ubicacion (Para poder mostrar en la vista el nombre de el pais)    1:1
    public function ubicacion(){
        return
        $this -> belongsTo(Ubicacion::class);
    }


    //Relacion de vacante con la experiencia (Para poder mostrar en la vista la experiencia exacta y no el id)    1:1
    public function experiencia(){
        return
        $this -> belongsTo(Experiencia::class);
    }



     //Relacion de vacante con usuario (Para poder mostrar en la vista el nombre del creador de la vacante)    1:1
     public function reclutador(){
        return
        $this -> belongsTo(User::class, 'user_id'); //En este caso como estamos consultando una tabla que es original de laravel (users) , le tenemos que especificar el intermediario que en este caso es el user_id
    }//'belongsTo' se declara en el modelo que contiene  la llave foranea,
    // De esta forma se puede decir que un registro le pertenece al dato al que apunta
    // su llave foranea


    //Relacion de vacante con candidatos (1 vacante puede tener varios candidatos)    1:n
    public function candidatos()
    {
        return $this->hasMany(Candidato::class);
    }


    //Relacion para likes inversa     n:n
    //Vacantes a las que le ha dado like el user
    public function likes(){
     return
     $this->belongsToMany(User::class,'likes_vacante');
    }


    public function comentario(){
        return $this->hasMany(Comentario::class);
    }


    public function vistas(){
           return $this->hasMany(Vista::class);
       }
}
