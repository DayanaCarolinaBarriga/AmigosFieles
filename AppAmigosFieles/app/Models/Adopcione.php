<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Adopcione
 *
 * @property $id
 * @property $id_animal
 * @property $id_adoptante
 * @property $fecha_adopcion
 * @property $estado_proceso
 * @property $cedula_path
 * @property $formulario_path
 * @property $visita_realizada
 * @property $fecha_visita
 * @property $comentarios_visita
 * @property $created_at
 * @property $updated_at
 *
 * @property Adoptante $adoptante
 * @property Animale $animale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Adopcione extends Model
{
    // Reglas de validación
    static $rules = [
        'id_animal' => 'required|exists:animales,id', // Validación de existencia de animal
        'id_adoptante' => 'required|exists:adoptantes,id', // Validación de existencia de adoptante
        'estado_proceso' => 'required|in:pendiente,aprobado,rechazado', // Validación de estado del proceso
        'fecha_adopcion' => 'nullable|date', // Validación de fecha de adopción
        'cedula_path' => 'nullable|mimes:pdf', // Validación de archivo PDF para la cédula
        'formulario_path' => 'nullable|mimes:pdf', // Validación de archivo PDF para el formulario
        'visita_realizada' => 'nullable|boolean', // Validación de si la visita inicial fue realizada
        'fecha_visita' => 'nullable|date', // Validación de la fecha de la visita inicial
        'comentarios_visita' => 'nullable|string', // Validación para comentarios sobre la visita inicial
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_animal', 
        'id_adoptante', 
        'fecha_adopcion', 
        'estado_proceso', 
        'cedula_path', 
        'formulario_path', 
        'visita_realizada', 
        'fecha_visita', 
        'comentarios_visita'
    ];

    /**
     * Relación con el adoptante.
     */
    public function adoptante()
    {
        return $this->belongsTo('App\Models\Adoptante', 'id_adoptante');
    }

    /**
     * Relación con el animal.
     */
    public function animale()
    {
        return $this->belongsTo('App\Models\Animale', 'id_animal');
    }

   
    /**
     * Verifica si los archivos y la fecha deben ser obligatorios según el estado del proceso.
     */
    public function validateFinalizadaFiles()
    {
        if ($this->estado_proceso === 'aprobado') {
            if (is_null($this->fecha_adopcion) || is_null($this->cedula_path) || is_null($this->formulario_path)) {
                return false; // Requiere los archivos y la fecha
            }
        }
        return true;
    }
}
