<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EspeciesAnimale
 *
 * @property $id
 * @property $especie
 * @property $created_at
 * @property $updated_at
 *
 * @property Animale[] $animales
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class EspeciesAnimale extends Model
{
    
    static $rules = [
		'especie' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['especie'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function animales()
    {
        return $this->hasMany('App\Models\Animale', 'id_especie', 'id');
    }
    

}
