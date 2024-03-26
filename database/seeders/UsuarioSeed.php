<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeed extends Seeder
{
    /**
     *        =======================   SEEDER PARA LOS USUARIOS ADMIN jaja ======================
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([
            'name' => 'MIGueladmin',
            'username' => 'miguelGod',
            'email' => 'miguel@miguel.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),   //La contraseña siempre debe ir hashteada  
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()
        ]);


        $user2 = User::create([
            'name' => 'juan',
            'username' => 'juanchop',
            'email' => 'juan@juan.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678'),   //La contraseña siempre debe ir hashteada  
            'created_at' => Carbon::now(),                   
            'updated_at' => Carbon::now()
        ]);
        

        //Otra manera
        // DB::table('users')->insert([
        //     'name' => 'juan',
        //     'username' => 'juanchop',
        //     'email' => 'juan@juan.com',
        //     'email_verified_at' => Carbon::now(),
        //     'password' => Hash::make('12345678'),   //La contraseña siempre debe ir hashteada  
        //     'created_at' => Carbon::now(),                   
        //     'updated_at' => Carbon::now()
        // ]);
        
       




    }
}
