<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SeguimientoAdopcione
 *
 * @property $id
 * @property $created_at
 * @property $updated_at
 *
 * @property VisitasSeguimiento[] $visitasSeguimientos
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SeguimientoAdopcione extends Model
{
    
    
    use HasFactory;

    protected $fillable = [
        'adopcion_id',
        'seguimiento',
        'comentario_seguimiento',
        'apto',
        'retiro_adopcion',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitasSeguimientos()
    {
        return $this->hasMany('App\Models\VisitasSeguimiento', 'seguimiento_id', 'id');
    }

    public function adopcion()
    {
        return $this->belongsTo(Adopcione::class, 'adopcion_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($seguimiento) {
            if (!$seguimiento->apto) {
                $seguimiento->adopcion->update(['estado_proceso' => 'rechazado']);
            }
        });
    }
    

}
