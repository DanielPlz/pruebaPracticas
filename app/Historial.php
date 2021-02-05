<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_historial
 * @property int $id_membresia
 * @property int $id_suscripcion
 * @property int $id_psicologo
 * @property string $fecha_inicio
 * @property string $fecha_final
 * @property int $dias_vigente
 * @property Membresium $membresium
 * @property Psicologo $psicologo
 * @property Suscripcion $suscripcion
 */
class Historial extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'historial';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_historial';

    /**
     * @var array
     */
    protected $fillable = ['id_membresia', 'id_suscripcion', 'id_psicologo', 'fecha_inicio', 'fecha_final', 'dias_vigente', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function membresium()
    {
        return $this->belongsTo('App\Membresium', 'id_membresia', 'id_membresia');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function psicologo()
    {
        return $this->belongsTo('App\Psicologo', 'id_psicologo', 'id_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function suscripcion()
    {
        return $this->belongsTo('App\Suscripcion', 'id_suscripcion', 'id_suscripcion');
    }
}
