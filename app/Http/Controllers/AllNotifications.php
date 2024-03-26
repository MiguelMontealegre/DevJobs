<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllNotifications extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $notificaciones = auth()->user()->notifications;

        return view('notificaciones.allnotifications', compact('notificaciones'));
    }
}
