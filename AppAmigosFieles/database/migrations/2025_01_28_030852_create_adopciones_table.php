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
        Schema::create('adopciones', function (Blueprint $table) {
            $table->id();

            // Relación con la tabla animales
            $table->foreignId('id_animal')
                  ->constrained('animales')
                  ->onDelete('restrict');

            // Relación con la tabla adoptantes
            $table->foreignId('id_adoptante')
                  ->constrained('adoptantes')
                  ->onDelete('restrict');

            // Información de la adopción
            $table->date('fecha_adopcion')->nullable(); // Fecha de adopción
            $table->enum('estado_proceso', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente'); // Estado del proceso
            $table->string('cedula_path')->nullable(); // Ruta del archivo PDF de la cédula del adoptante
            $table->string('formulario_path')->nullable(); // Ruta del archivo PDF del formulario de adopción

            // Detalles de la primera visita
            $table->boolean('visita_realizada')->default(false); // Indica si la primera visita fue realizada
            $table->date('fecha_visita')->nullable(); // Fecha de la primera visita
            $table->text('comentarios_visita')->nullable(); // Comentarios sobre la primera visita

            $table->timestamps(); // Marcas de tiempo para creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adopciones');
    }
};
