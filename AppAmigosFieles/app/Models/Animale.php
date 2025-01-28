<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Animale
 *
 * @property $id
 * @property $nombre
 * @property $especie
 * @property $sexo
 * @property $fecha_nacimiento
 * @property $esterilizado
 * @property $fecha_ingreso
 * @property $estado
 * @property $foto_path
 * @property $created_at
 * @property $updated_at
 *
 * @property Adopcione[] $adopciones
 * @property Tratamiento[] $tratamientos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Animale extends Model
{
    static $rules = [
        'nombre' => 'required',
        'id_especie' => 'required',
        'sexo' => 'required',
        'esterilizado' => 'required',
        'fecha_ingreso' => 'required',
        'estado' => 'required',
        'fecha_nacimiento' => 'nullable|date',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'id_especie',
        'sexo',
        'fecha_nacimiento',
        'esterilizado',
        'fecha_ingreso',
        'estado',
        'foto_path',
    ];

    /**
     * Relación con adopciones.
     */
    public function adopciones()
    {
        return $this->hasMany('App\Models\Adopcione', 'id_animal', 'id');
    }
    
    /**
     * Relación con tratamientos.
     */
    public function tratamientos()
    {
        return $this->hasMany('App\Models\Tratamiento', 'id_animal', 'id');
    }

    /**
     * Relación con la especie.
     */
    public function especie()
    {
        return $this->belongsTo('App\Models\EspeciesAnimale', 'id_especie', 'id');
    }
}
