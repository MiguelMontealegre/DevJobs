<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([  //El parametro de table debe ser el mismo que el nombre de la tabla en la migracion,despues ponemos un insert para insertar el arreglo. (si el DB sale con error debemos importar la clase)
    
            'nombre' => 'Front End',             //Y como podemos ver tenemos que agregar exactamente los mismos campos que tenemos en la tabla (de la migracion)
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        //Y en este caso laravel tiene una herramienta para manejar las fechas la cual es "Carbon" y hay que importarla ... En casos anteriores hemos utilizado esta sintaxis que tambien es valida date('Y-m-d H:i:s')
           ]);


        
           DB::table('categorias')->insert([  
            'nombre' => 'Backend',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);   


           DB::table('categorias')->insert([  
            'nombre' => 'Full Stack',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]); 


           DB::table('categorias')->insert([  
            'nombre' => 'Devops',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]); 

           DB::table('categorias')->insert([  
            'nombre' => 'DBA',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]); 


           DB::table('categorias')->insert([  
            'nombre' => 'UX / UI',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]); 


           DB::table('categorias')->insert([  
            'nombre' => 'Techlead',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]); 


           
    }
}
