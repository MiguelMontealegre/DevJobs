<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Candidato;
use Illuminate\Http\Request;
use App\Notifications\NuevoCandidato;

class CandidatoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        //De esta forma leemos el "id" de la vacante que se selecciono, que se manda desde la ant pagina y queda en la ruta
        $id_vacante = $request->route('id');


        //Y de esta forma obtenemos ese id de la vacante y asi acceder a otros campos y relaciones
        $vacante = Vacante::findOrFail( $id_vacante );



        //Policy , solo el creador de la vacante podra ver los candidatos postulados
        $this->authorize('view', $vacante);
        

        return view('candidatos.index', compact('vacante'));

    }





    
    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    

        //Validacion de campos   
        $data = $request->validate([    
            'nombre' => 'required|max:50',          
            'edad' => 'required|max:2',
            'email' => 'required|email',
            'profesion' => 'required|max:150',
            'telefono' => 'required|max:16',
            'descripcion' => 'required',
            'cv' => 'required|mimes:pdf|max:1000',
            'vacante_id' => 'required' 
        ]); 


        //Guardar archivo PDF
        if($request->file('cv')){   //Esto se ve raro pero es muy simple , quiere decir que "si se hizo la solicitud para un campo llamado "cv" , esta solicitud la hacemos cuando llenamos el campo de PDF en nuestro formulario de candidatos

            $archivo = $request->file('cv');  //La variable "archivo" sera igual a el pdf que subamos en el form
            $nombreArchivo = time() . "." . $request->file('cv')->extension(); //Esta variable sera igual a como su nombre lo indica el nombre completo de ese pdf ...  "time()" ->Hora en que se subio este archivo , le concatenamos con un "." el nombre de el archivo , y le concatenamos otra vez con el "." la extension que seria "pdf"   ...   Al final quedaria algo asi:  hora.archivo.pdf       
            $ubicacion = public_path('/storage/cv');  //Vamos a guardar los pdf en la carpeta cv , ubicada en storage
            $archivo -> move($ubicacion, $nombreArchivo);  //Aqui simplemente le decimos que mueva ese archivo a la ubicacion que definimos previamente en la variable :  $ubicacion
        
            //  "$nombreArchivo"  Es lo que se almacenara en la base de datos
        }




        //De esta forma obtenemos el id de la vacante EN BASE A EL $data DE LA VALIDACION ... Si recordamos en el formulario agregamos un input hidden con la intencion de que tambien se enviara el id de la vacante para ello en el campo value de ese input agregamos automaticamente el id de la vacante que se este viendo , por lo cual ese $data tendria ese valor 
        $vacante = Vacante::find($data['vacante_id']);

       

        //Guardar campos en BD
        //Sabemos que "$vacante" contiene el id de la vacante a la que se esta postulando el usuario , entonces con esa base y con la relacion que creamos de "1 vacante puede tener varios candidatos" , guardamos los campos de ese candidato
                 //
        $vacante->candidatos()->create([
        'nombre' => $data['nombre'],
        'edad' => $data['edad'],
        'email' => $data['email'],
        'profesion' => $data['profesion'],
        'telefono' => $data['telefono'],
        'descripcion' => $data['descripcion'],
        'cv' => $nombreArchivo
       ]);

       

       
    //Otra forma de guardar require fillable ... Funciona heredando la info de la validacion por lo cual no hay que ir guardando uno por uno si no que todos los campos que esten en validacion tambien se guardaran aqui ... y al final solo se pone el metodo de "save()"
    //    $candidato = new Candidato($data);
    //    $candidato->save();



    //Otra forma de guardar require fillable ... Funciona heredando la info de la validacion por lo cual no hay que ir guardando uno por uno si no que todos los campos que esten en validacion tambien se guardaran aqui ... y al final solo se pone el metodo de "save()"
    //    $candidato = fill($data);
    //    $candidato->save();



    
     


       //NOTIFICAR a el reclutador por un nuevo candidato__________________________________________________________

                               //Relacion
       $reclutador = $vacante->reclutador;                              //Definir el reclutador AUTOR de esa vacante por medio de la relacion             
       $reclutador -> notify( new NuevoCandidato($vacante->titulo, $vacante->id) );   //Notificar al reclutador   ... Ese codigo se puede simplificar:  Importando la clase de NuevoCandidato() , y ya al hacer eso podemos borrar el resto , quedaria asi:  $reclutador->notify( new NuevoCandidato() );     ___ sin importar la clase es asi:  $reclutador->notify( new \App\Notifications\NuevoCandidato() );                


       //Le pasamos Por medio de la variable "$vacante" definida anteriormente el titulo , podriamos pasarle cualquier campo de la tabla tambien si se desea

       




       //Redireccion del metodo store
       return back()->with('estado', 'Tus datos se han enviado correctamente  ;)  Suerte!');  

       /*Para mostrar un aviso que diga que "los datos se han enviado correctamente"
         primero sabemos que al utilizar el metodo back() se devuelve a pag anterior , en este caso nos redirigira a el mismo formulario , ya que despues de la postulacion va al store y se devuelve a la misma postulacion
         Y entonces le agregamos a ese "back" un  with()  el cual va a tener 2 parametros, el primero va a ser la variable (llave) con la que vamos a acceder a la info que va en el segundo parametro, ese segundo parametro puede ser un mensaje , aviso etc */


    }










    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function show(Candidato $candidato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidato $candidato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Candidato $candidato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidato  $candidato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidato $candidato)
    {
        //
    }
}
