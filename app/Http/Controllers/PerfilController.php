<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Perfil;
use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Perfil $perfil)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Perfil $perfil)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $perfil)
    {
        $vacantes = Vacante::where('user_id' , $perfil->user_id)->paginate(3);
        
        return view('perfiles.show' , compact('perfil' , 'vacantes'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $perfil)
    {
        
        return view('perfiles.edit', compact('perfil'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil, User $user)
    {
        
        //Validacion
        $data = request()->validate([
            'nombre' => 'required|min:2',                                   // Y le pasamos "validate"(que es un metodo que existe en el request) , y despues le pasamos un arreglo con lo que se va a validar en este caso "required" pa que sea obligatorio (puedes aplicar variaciones de acuerdo a las reglas de validacion como maxima cantidad de caracteres ,minima etc)
            'biografia' => 'required',
            'imagen' => 'required'
            ]);
        

            // Actualizando campos
        $user->where('id', $perfil->user_id)
        ->update([
            'name' => $data['nombre'],
        ]);    

        $perfil->biografia = $data['biografia'];
        $perfil->imagen = $data['imagen'];
        $perfil->save();

        //_______________________________________________
    
    
        //redireccionar
        return redirect()->action('\App\Http\Controllers\VacanteController@index');
    
    }


    //METODOS EXTRA______________________________________________________________________________________

    //SUBIR IMAGENES CON DROPZONE
    public function imagen(Request $request){

        $imagen = $request->file('file');
        $nombreImagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/perfiles'), $nombreImagen );
        return response()->json(['correcto' => $nombreImagen]);
    }


    // Borrar imagen de dropzone via Ajax
    public function borrarimagen(Request $request)
    {
        if($request->ajax()) {
            $imagen = $request->get('imagen');
                                                          //La clase "File" se debe importar con:  iluminate/support/facades/file
            if( File::exists( 'storage/perfiles/' . $imagen ) ) {
                File::delete( 'storage/perfiles/' . $imagen );
            }
            return response('Imagen Eliminada', 200);
        }
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
