<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_suscripcion
 * @property string $nombre
 * @property string $descripcion
 * @property int $tipo
 * @property int $comision
 * @property int $precio
 * @property string $created_at
 * @property string $updated_at
 * @property DetallePago[] $detallePagos
 * @property Historial[] $historials
 */
class Suscripcion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'suscripcion';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_suscripcion';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion', 'tipo', 'comision', 'precio', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePagos()
    {
        return $this->hasMany('App\DetallePago', 'id_suscripcion', 'id_suscripcion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historials()
    {
        return $this->hasMany('App\Historial', 'id_suscripcion', 'id_suscripcion');
    }
}
