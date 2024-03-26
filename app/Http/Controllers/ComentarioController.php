<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $comentarios = Comentario::where('vacante_id', $request->id)
        ->join('users', 'users.id', '=', 'comentarios.user_id')
        ->join('perfils', 'perfils.user_id', '=', 'users.id')
        ->get(['comentarios.reply_name', 'comentarios.id', 'comentarios.comentario_id', 'comentarios.content', 'comentarios.user_id', 'perfils.imagen', 'comentarios.created_at']);

        $test = $comentarios->map(function($comment){
            return[
            'commentId' => $comment->id,
            'reply_id' => $comment->comentario_id,
            'reply_name' => $comment->reply_name,
            'content' => $comment->content,
            'name' => $comment->user->name,         //Aqui por ejem usamos relaciones para acceder a los campos de users , pero con la implementacion de los joins ya no serian necesarios
            'userid' => $comment->user_id,          
            'username' => $comment->user->username,
            'created_at' => $comment->created_at->diffForHumans(),
            'img' => $comment->imagen,
            'likesCom' => $comment->likesComment->count(),
            'likeCom' => ( auth()->user() ) ?  auth()->user()->meGustaComment->contains($comment->id) : false
            ];
        });

        
        // $likeCom = ( auth()->user() ) ?  auth()->user()->meGustaComment->contains($comment->id) : false;   //Si no esta autenticado retorna 'false' ... SI esta autenticado pasa a revisar si ya le dio me gusta , y si ya le ha dado like retorna false
        // $likesCom = $comment->likesComment->count();

        return response()->json($test);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'content' => 'required',          
            'user_id' => 'required',
            'vacante_id' => 'required',
        ]);

        //Guardar campos en BD
       auth()->user()->comentarios()->create([
        'content' => $data['content'],
        'user_id' => $data['user_id'],
        'vacante_id' => $data['vacante_id'],
       ]);


       //Redireccion a la vacante
       //return redirect()->action('\App\Http\Controllers\VacanteController@show'); 
       return redirect()->route('vacantes.show', $data['vacante_id']);
    }




    public function store2(Request $request, Comentario $comentario)
    {
       
        $comentario->user_id = $request->userId;
        $comentario->vacante_id = $request->vacanteId;
        $comentario->comentario_id = $request->comentario_id;       //$request->comentario_id 
        $comentario->content = $request->content;
        $comentario->reply_name = $request->nameRep;

        $comentario->save();

        return response()->json(['respuesta' => 'Correcto']);
    }







    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit(Comentario $comentario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comentario $comentario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comentario $comentario)
    {
        $comentario->delete();

        return response()->json(['mensaje' => 'Se elimino tu comentario' . ' ' . $comentario->user->name ]);
    }
}
