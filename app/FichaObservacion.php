<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_observacion
 * @property int $id_sesion
 * @property string $observacion
 * @property string $created_at
 * @property string $updated_at
 * @property FichaSesion $fichaSesion
 */
class FichaObservacion extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ficha_observacion';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_observacion';

    /**
     * @var array
     */
    protected $fillable = ['id_sesion', 'observacion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichaSesion()
    {
        return $this->belongsTo('App\FichaSesion', 'id_sesion', 'id_sesion');
    }
}
