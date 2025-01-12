<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('ubicacions')->insert([  
            'nombre' => 'Remoto',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

        
           DB::table('ubicacions')->insert([  
            'nombre' => 'USA',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]); 

           DB::table('ubicacions')->insert([  
            'nombre' => 'Canada',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'Mexico',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'Resto de Centro America',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'Colombia',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'Resto de Sur America',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'España',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'Rusia',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);


           DB::table('ubicacions')->insert([  
            'nombre' => 'Resto de Europa',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'Australia',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

        

           DB::table('ubicacions')->insert([  
            'nombre' => 'China',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);

           DB::table('ubicacions')->insert([  
            'nombre' => 'Resto de Asia',             
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()        
           ]);
    }
}
