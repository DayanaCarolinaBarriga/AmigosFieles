<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adoptante extends Model
{
    // Reglas de validación actualizadas
    static $rules = [
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|numeric',
        'correo' => 'required|email|max:255',
        'direccion' => 'required|string|max:255',
        'cedula' => 'required|string|min:10|max:10|regex:/^[0-9]+$/', // Validación básica
        'estado' => 'required|in:activo,inactivo',
        'tipo_vivienda' => 'required|in:casa,departamento', // Validación para tipo de vivienda
        'cerramiento' => 'required|boolean', // Validación para cerramiento
        'vivienda_arrendada' => 'required|boolean', // Validación para vivienda arrendada
        
    ];

    protected $perPage = 20;

    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'direccion',
        'cedula',
        'edad',
        'ocupacion',
        'estado',
        'tipo_vivienda',
        'cerramiento',
        'vivienda_arrendada'
        
    ];

   

    /**
     * Relación con la tabla 'adopciones'.
     * Un adoptante puede tener muchas adopciones.
     *
     * @return HasMany
     */
    public function adopciones(): HasMany
    {
        return $this->hasMany('App\Models\Adopcione', 'id_adoptante', 'id');
    }

    /**
     * Eliminación lógica del adoptante: cambiar el estado a 'inactivo'.
     *
     * @return void
     */
    public function eliminarLogico()
    {
        $this->update(['estado' => 'inactivo']);
    }

    
}
