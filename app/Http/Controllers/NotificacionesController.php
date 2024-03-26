<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class NotificacionesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        
        //Obtener notificaciones NO leidas
        $notificaciones = auth()->user()->unreadNotifications;


        //Reiniciar el count cuando se visite la vista de notificaciones
        auth()->user()->unreadNotifications->markAsRead();



        return view('notificaciones.index', compact('notificaciones'));
    }
}
