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
        Schema::create('adoptantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('telefono');
            $table->string('correo')->unique();
            $table->text('direccion');
            $table->string('cedula');
            $table->integer('edad');
            $table->string('ocupacion');
            $table->enum('estado', ['activo', 'inactivo'])->default('activo'); // Estado con valor por defecto 'activo'
            $table->enum('tipo_vivienda', ['casa', 'departamento']); // Tipo de vivienda: casa o departamento
            $table->boolean('cerramiento')->default(false); // Indica si tiene cerramiento
            $table->boolean('vivienda_arrendada')->default(false); // Indica si la vivienda es arrendada
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
        Schema::dropIfExists('adoptantes');
    }
};
