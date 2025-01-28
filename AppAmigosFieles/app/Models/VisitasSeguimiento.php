<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VisitasSeguimiento
 *
 * @property $id
 * @property $seguimiento_id
 * @property $visita
 * @property $fecha_visita
 * @property $created_at
 * @property $updated_at
 *
 * @property SeguimientoAdopcione $seguimientoAdopcione
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class VisitasSeguimiento extends Model
{
  use HasFactory;

  protected $table = 'visitas_seguimiento';

  protected $fillable = [
      'seguimiento_id',
      'visita',
      'fecha_visita',
      'comentario',
  ];
    
    static $rules = [
		'seguimiento_id' => 'required',
		'visita' => 'required',
    'fecha_visita' => 'nullable|date',
    'comentario' => 'nullable|string',
    ];

    protected $perPage = 20;

    


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function seguimientoAdopcione()
    {
        return $this->hasOne('App\Models\SeguimientoAdopcione', 'id', 'seguimiento_id');
    }
    

}
