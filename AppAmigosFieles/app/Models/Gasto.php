<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Gasto
 *
 * @property $id
 * @property $id_users
 * @property $id_tipo_gasto
 * @property $descripcion
 * @property $monto
 * @property $fecha
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property TipoGasto $tipoGasto
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Gasto extends Model
{
    static $rules = [
        'id_users' => 'required|exists:users,id',
        'id_tipo_gasto' => 'required|exists:tipo_gastos,id',
        'monto' => 'required|numeric',
        'fecha' => 'required|date',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_users', 'id_tipo_gasto', 'descripcion', 'monto', 'fecha'];

    /**
     * Relación con el usuario.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_users');
    }

    /**
     * Relación con el tipo de gasto.
     */
    public function tipoGasto()
    {
        return $this->belongsTo('App\Models\TipoGasto', 'id_tipo_gasto');
    }
}
