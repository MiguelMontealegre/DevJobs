<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail   //1° Para la verificacion de email a el momento de registro como 1° paso debemos agregar esos dos parametros de:  "implements MustVerifyEmail"
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',   //Agregar campo nuevo
        'email',
        'password',   
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //RELACION PRINCIPAL PARA STORAGE (Guardar vacantes en DB) !!!   Users-vacantes   -1 usuario puede crear varias vacantes-
    public function vacantes(){
        return 
        $this->hasMany(Vacante::class);
    }

    //RELACION PARA LIKES de muchos a muchos    n:n
    //Likes que recibira una vacante
    public function meGusta(){
        return
        $this->belongsToMany(Vacante::class, 'likes_vacante')
        ->withTimestamps();
    }//'belongsTo' se declara en el modelo que contiene  la llave foranea,
    // De esta forma se puede decir que un registro le pertenece al dato al que apunta
    // su llave foranea
    

    
    // EVENTOS PARA PERFILES
    //Evento que se ejecuta cuando un usuario es creado
    protected static function boot(){

        parent::boot();
        //Asignar perfil una vez se cree el usuario
        static::created(function ($user) {
            $user->perfil()->create();                      //Ya con esto  y tambien gracias a la relacion , automaticamente cuando un usuario se registre, los campos de la migracion de los perfiles se llenaran con la info de ese usuario
        });   //perfil:relacion 1:1 U->P
     }

     
    //Relacion 1:1 para perfiles
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }
    

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }


    //RELACION PARA LIKES de muchos a muchos    n:n
    //Likes que recibira una vacante
    public function meGustaComment(){
        return
        $this->belongsToMany(Comentario::class, 'likes_comentario');
    }


    public function vistaUser(){
        return
        $this->belongsToMany(Vacante::class, 'vistas_vacante')
        ->withTimestamps();
    }
}
