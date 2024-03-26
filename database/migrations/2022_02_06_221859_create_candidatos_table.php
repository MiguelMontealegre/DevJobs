<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');
            $table->string('edad');
            $table->string('telefono');
            $table->string('profesion');
            $table->string('email');
            $table->text('descripcion')->nullable();
            $table->string('cv')->nullable();
            $table->string('vacante_id')->constrained();   //Esta la agregamos para tener una referencia de con que vacante en especico se estan postulando los candidatos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidatos');
    }
}
