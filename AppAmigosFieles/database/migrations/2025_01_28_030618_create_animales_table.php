<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('id_especie')->constrained('especies_animales')->onDelete('cascade'); 
            $table->enum('sexo', ['macho', 'hembra']);
            $table->date('fecha_nacimiento')->nullable();
            $table->boolean('esterilizado')->default(false);
            $table->date('fecha_ingreso');
          
            $table->enum('estado', ['disponible', 'no_disponible','adoptado'])->default('disponible'); // El estado ahora solo maneja disponible y no disponible
            $table->string('foto_path')->nullable(); // Ruta de la foto del animal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animales');
    }
};
