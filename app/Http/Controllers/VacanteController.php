<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Vista;
use App\Models\Perfil;
use App\Models\Salario;
use App\Models\Vacante;
use App\Models\Candidato;
use App\Models\Categoria;
use App\Models\Ubicacion;
use App\Models\Comentario;
use GuzzleHttp\Middleware;
use App\Models\Experiencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{

    /*En este caso vamos a proteger nuestro proyecto con otra forma de hacer el middleware, la cual es agrupando las rutas
    Lo podemos ver en el archivo routes/web.php    */






    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Consultar Vacantes
        //$vacantes = auth()->user()->vacantes;                                     De esta forma las traeriamos todas, con la siguiente que es consultando el modelo las podemos paginar
        $vacantes = Vacante::where('user_id' , auth()->user()->id)->orderBy('created_at', 'desc')->simplePaginate(6);   //Consultando las vacantes de esta forma nos reservamos el privilegio de solo obtener las creadas por usuarios autenticados
        
       return view('vacantes.index', compact('vacantes'));
    }


    public function index2(Request $request)
    {
        $page = (int)$request->get('page', 1);
        $query = $request->get('search');
        // $query = $request->input('params')['search'];

        $vacantes = Vacante::where('user_id' , auth()->user()->id)
        ->orderBy('vacantes.created_at', 'desc')->paginate(6, ['*'], 'page', $page);

        if ($query) {
            $query2 = '%' . $query . '%';
            $vacantes2 =
                Vacante::query()
                ->where('user_id' , auth()->user()->id)
                ->where('titulo', 'LIKE', $query2);

                $definitiveVacantes2 = $vacantes2->paginate(6, ['*'], 'page', $page);
                $definitiveVacantes2->getCollection();


                foreach($definitiveVacantes2 as $key => $vacante){
                    $vacante->numCandidatos = $vacante->candidatos->count();
                    $vacante->id = $vacante->id;
                    $vacante->titulo = $vacante->titulo;
                    $vacante->nombCategoria = $vacante->categoria->nombre;
                    $vacante->estado = $vacante->activa;
                    $vacante->created = $vacante->created_at->diffForHumans();
                    $vacante->imagen = $vacante->imagen;
                    $vacante->numLikes = $vacante->likes->count();
                    $vacante->numComentarios = $vacante->comentario->count();
                    $vacante->porcentaje = ($vacante->candidatos->count() * 100) / $vacante->puestos;
                }
                return response()->json($definitiveVacantes2);
        }

  
        foreach($vacantes as $key => $vacante){
            $vacante->numCandidatos = $vacante->candidatos->count();
            $vacante->id = $vacante->id;
            $vacante->titulo = $vacante->titulo;
            $vacante->nombCategoria = $vacante->categoria->nombre;
            $vacante->estado = $vacante->activa;
            $vacante->created = $vacante->created_at->diffForHumans();
            $vacante->imagen = $vacante->imagen;
            $vacante->numLikes = $vacante->likes->count();
            $vacante->numComentarios = $vacante->comentario->count();
            $vacante->porcentaje = ($vacante->candidatos->count() * 100) / $vacante->puestos;
        }
        return response()->json($vacantes);
    }


    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()

    {                 //Modelo
        $categorias = Categoria::all();  //La variable "categorias" es con la que se obtienen las categorias del seeder las cuales estan conectadas con la tabla de categorias (consultando el modelo de: "Categoria")                        
        
        $experiencias = Experiencia::all();  //Obtenemos las experiencias,consultando el modelo "Experiencia"  
        
        $ubicacion = Ubicacion::all();  //Obtenemos la ubicacion ,consultando modelo "Ubicacion"

        $salarios = Salario::all();

       return view('vacantes.create', compact('categorias' , 'experiencias' , 'ubicacion' , 'salarios') ) ;
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
        'titulo' => 'required|min:6',          
        'categoria' => 'required',
        'experiencia' => 'required',
        'ubicacion' => 'required',
        'salario' => 'required',
        'descripcion' => 'required|min:30',
        'puestos' => 'required|numeric|min:1',
        'imagen' => 'required',   //En este caso como estamos subiendo la imagen al servidor por via "ajax" no hay que ponerle que sea formato "imagen" obligatorio, ya que eso se hace alla en ajax
        'skills' => 'required'
    ]); 

       

       //Guardar campos en BD
       auth()->user()->vacantes()->create([
        'titulo' => $data['titulo'],
        'imagen' => $data['imagen'],
        'descripcion' => $data['descripcion'],
        'puestos' => $data['puestos'],
        'skills' => $data['skills'],
        'categoria_id' => $data['categoria'],
        'experiencia_id' => $data['experiencia'],
        'ubicacion_id' => $data['ubicacion'],
        'salario_id' => $data['salario'],
       ]);


       //Redireccion a pag principal
       return redirect()->action('\App\Http\Controllers\VacanteController@index');      
}


   



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function show(Vacante $vacante)
    {
        //$vacantes = auth()->user()->vacantes;                        podriamos pasarle las vacantes de esta forma pero el metodo show ya por default consulta el modelo que tiene asociado en sus parentesis (linea 122) entonces de alguna forma ya viene incluida esa info... DE ESTA FORMA QUE ESTA COMENTADA , OBTENDRIAMOS LA INFO DE ESE MODELO EN FORMA DE ARREGLO YA QUE ESTAMOS UTILIZANDO "get()" o "all()"


       //Obtener Si el usuario actual le gusta la receta y esta autenticado (Campo de likes) , en este caso por medio de la variable '$like'
       $like = ( auth()->user() ) ?  auth()->user()->meGusta->contains($vacante->id) : false;   //Si no esta autenticado retorna 'false' ... SI esta autenticado pasa a revisar si ya le dio me gusta , y si ya le ha dado like retorna false
                                    //Revisa si ya le dio me gusta__________________


        //Pasa la cantidad de likes a la vista (Es decir muestra cuantos likes ha tenido dicha receta) ...Por medio de la variable: '$likes'
        $likes = $vacante->likes->count();                             
                           //Rel

        // $comentarios = Comentario::where('vacante_id', $vacante->id)->get();

        $candidatos = Candidato::where('vacante_id', $vacante->id)->get();
        $perfil = Perfil::where('user_id', $vacante->user_id)->get();

        $autor = User::where('users.id',$vacante->user_id)
        ->join('perfils', 'perfils.user_id', '=', 'users.id')
        ->get();

        if(isset(auth()->user()->id)){
        $user = User::where('users.id',auth()->user()->id)
        ->join('perfils', 'perfils.user_id', '=', 'users.id')
        ->get();
        }
        else{
            $user = 0;
        }


        //CONTADOR DE VISTAS A LA VACANTE
            // DB::table('vistas_vacante')->updateOrInsert([
            //     'vacante_id' => $vacante->id,
            // ],['vistas' => DB::raw('vistas + 1'),
            //    'vacante_id' => $vacante->id,
            //    'user_id' => auth()->user()->id,
            //    'registered_user' => 1
            // ]);

        if (auth()->user()->id !== $vacante->user_id){
            $vacante->vistas()->create([
                'user_id' => auth()->user()->id,
               ]);
        }
        
        $vistas = Vista::where('vacante_id', $vacante->id)->get();
        $definitiveVistas = $vistas->map(function($vis){
            return[
                'vacante_id' => $vis->vacante_id,
                'user_id' => $vis->user_id,
                'created' => $vis->created_at
            ];
        });
        //----------------------
        $likesStats = $vacante->likes()->get();
        $definitiveLikesStats = $likesStats->map(function($like){
            return[
                'vacante_id' => $like->pivot->vacante_id,
                'user_id' => $like->pivot->user_id,
                'created' => $like->created_at
            ];
        });
        //----------------------
        $commentsStats = $vacante->comentario;
        

        return view('vacantes.show', compact(
            'vacante','candidatos','perfil', 'like',
            'likes', 'autor', 'user', 'definitiveVistas', 
            'definitiveLikesStats','commentsStats'
        ));              //"vacante" Es la variable que consulta el modelo de Vacante, esto lo hace automaticamente el metodo show en sus parentesis de la linea 122
    }






    //Create enfocado en la postulacion (crear la info de los candidatos)
    public function postulacion(Vacante $vacante)
    {
        return view('vacantes.postulacion', compact('vacante'));             
    }



    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacante $vacante)
    {

        //Policy , para que solo la pueda editar el que la creo
        $this->authorize('view', $vacante);


        //consultas al modelo
        $categorias = Categoria::all();                  
        
        $experiencias = Experiencia::all();  
        
        $ubicacion = Ubicacion::all();  

        $salarios = Salario::all();


        return view('vacantes.edit', compact('vacante','categorias','experiencias','ubicacion','salarios'));
        
    }







    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacante $vacante)
    {

        //Policy , para que solo la pueda actualizar el que la creo
        $this->authorize('update', $vacante);


        
        //Validacion
        $data = request()->validate([       
            'titulo' => 'required|min:6',          
            'categoria' => 'required',
            'experiencia' => 'required',
            'ubicacion' => 'required',
            'salario' => 'required',
            'descripcion' => 'required|min:30',
            'imagen' => 'required',   //En este caso como estamos subiendo la imagen al servidor por via "ajax" no hay que ponerle que sea formato "imagen" obligatorio, ya que eso se hace alla en ajax
            'skills' => 'required'
        ]); 



        // Actualizando campos
        $vacante->titulo = $data['titulo'];
        $vacante->skills = $data['skills'];
        $vacante->imagen = $data['imagen'];
        $vacante->descripcion = $data['descripcion'];
        $vacante->categoria_id = $data['categoria'];
        $vacante->experiencia_id = $data['experiencia'];
        $vacante->ubicacion_id = $data['ubicacion'];
        $vacante->salario_id = $data['salario'];
        
        $vacante->save();


        //redireccion
        return redirect()->action('\App\Http\Controllers\VacanteController@index');
    }







    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacante  $vacante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacante $vacante, Request $request)
    {
        //Policy , para que solo la pueda eliminar el que la creo
        $this->authorize('delete', $vacante);


        $vacante->delete();    //Eliminamos la vacante
        $vacante->candidatos()->delete();   //Eliminamos tambien los candidatos que se presentaron a esa vacante
        

        //Aqui lo que hacemos es que cunado confirmemos la eliminacion estamos retornando este mensaje el cual contiene el titulo de la vacante , entonces este mensaje lo relacionamos con el componente de vue , y cuando sweetalert nos confirme que se elimino mostremos este mensaje especificando cual receta fue la que se mocho
        return response()->json(['mensaje' => 'Se elimino la vacante' . $vacante->titulo ]);
    }




    //Metodo para el BUSCADOR CON IMAGEN DE FONDO_____________________________________________
    public function search(Request $request)
    {
      //$busqueda = $request['buscar'];   Otra forma de hacerlo
      $busqueda = $request->get('buscar');    //buscar es el mismo que pusimos en el name del input de busqueda


      $vacantes = Vacante::where('titulo', 'like', '%' . $busqueda . '%' )->paginate(4);  //Para esta herramienta de buscador vamos a usar el operador like que nos sirve para esto
      $vacantes->appends(['buscar'=> $busqueda]);                 //El caracer de "%" lo ponemos para que al poner una palabra busque referencias relacionadas y nos las sugiera en la busqueda
                                                                                                  

      return view('busquedas.show', compact('vacantes' , 'busqueda'));                            
    } 




    //Filtrador de vacantes en funcion de categoria y ubicacion______________________________________

    public function filtrar(Request $request){
// validar
    $data = $request->validate([
    'categoria' => 'required',
    'ubicacion' => 'required'
]);

    // ASIGNAR VALORES
    $categoria = $data['categoria'];
    $ubicacion = $data['ubicacion'];


    $vacantes = Vacante::latest()
   ->where('categoria_id', $categoria)
   ->where('ubicacion_id', $ubicacion)
   ->get();

// $vacantes = Vacante::where([
//     'categoria_id' => $categoria,
//     'ubicacion_id' => $ubicacion
// ])->get();

return view('busquedas.index', compact('vacantes'));
    }


 



    //METODOS EXTRA______________________________________________________________________________________

    //SUBIR IMAGENES CON DROPZONE
    public function imagen(Request $request){

        $imagen = $request->file('file');
        $nombreImagen = time() . '.' . $imagen->extension();
        $imagen->move(public_path('storage/vacantes'), $nombreImagen );
        return response()->json(['correcto' => $nombreImagen]);
    }


    // Borrar imagen de dropzone via Ajax
    public function borrarimagen(Request $request)
    {
        if($request->ajax()) {
            $imagen = $request->get('imagen');
                                                          //La clase "File" se debe importar con:  iluminate/support/facades/file
            if( File::exists( 'storage/vacantes/' . $imagen ) ) {
                File::delete( 'storage/vacantes/' . $imagen );
            }
            return response('Imagen Eliminada', 200);
        }
    }



    //Cambiar estado de la vacante
    public function estado(Request $request, Vacante $vacante)
    {
        //Leer nuevo estado de vacante
        $vacante->activa = $request->estado;


        //Guardar estado en DB
        $vacante->save();

        return response()->json(['respuesta' => 'Correcto']);

    //    return response()->json($vacante);

    }


    public function test(){
        

        $data =  Vacante::join('categorias', 'categorias.id', '=', 'vacantes.categoria_id')
        ->join('experiencias', 'experiencias.id', '=', 'vacantes.experiencia_id')
        ->join('salarios', 'salarios.id', '=', 'vacantes.salario_id')
        ->get(['vacantes.titulo','categorias.nombre', 'experiencias.created_at', 'salarios.id']);

        $test = 'holaaa';         

        return view('vacantes.test', compact('data','test'));


        // $test = $vacante->join('comentarios', 'comentarios.vacante_id', '=', 'vacantes.id')->get();
        // $dateT = $vacante->created_at;
        // return dd(date('m-d', strtotime($dateT)));
        // $year = date('Y', strtotime($dateT));

        // return dd(date('L', strtotime("$year-01-01")));
        // return dd(date('m-d', time()));
        // $originalDate = Carbon::parse($vacante->created_at);
        // $thisYearsDate = $originalDate->copy()->year(date('Y'));
        // return dd(date('Y'));

    }




}