<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(class: UsuarioSeed ::class);

        $this->call(class: CategoriaSeed ::class);       //Llamamos a los seeder que hemos creado de esta forma (metodo de forma individual)
        
        $this->call(class: ExperienciaSeeder ::class);

        $this->call(class: UbicacionSeed ::class);

        $this->call(class: SalarioSeed ::class);

    }
}
