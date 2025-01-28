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
        Schema::create('seguimiento_adopciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adopcion_id')->constrained('adopciones')->onDelete('cascade');
            $table->boolean('seguimiento')->default(false); // Indica si se está realizando seguimiento
            $table->text('comentario_seguimiento')->nullable();
            $table->boolean('apto')->default(true);
            $table->boolean('retiro_adopcion')->default(false);
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
        Schema::dropIfExists('seguimiento_adopciones');
    }
};
