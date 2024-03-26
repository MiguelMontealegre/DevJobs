<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{

    protected $fillable = [
        'content',
        'user_id',
        'vacante_id', 
        'comentario_id'    
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vacante(){
        return $this->belongsTo(Vacante::class, 'vacante_id');
    }

    public function hijo(){
        return $this->belongsTo(Comentario::class, 'comentario_id');
    }

    public function likesComment(){
        return
        $this->belongsToMany(User::class,'likes_comentario');  
       }
}
