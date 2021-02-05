<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_membresia
 * @property string $nombre
 * @property string $descripcion
 * @property int $tipo
 * @property int $precio
 * @property string $created_at
 * @property string $updated_at
 * @property DetallePago[] $detallePagos
 * @property Historial[] $historials
 */
class Membresia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'membresia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_membresia';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'tipo', 'precio', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePagos()
    {
        return $this->hasMany('App\DetallePago', 'id_membresia', 'id_membresia');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historials()
    {
        return $this->hasMany('App\Historial', 'id_membresia', 'id_membresia');
    }
}
