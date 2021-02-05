<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_detalle_pago
 * @property int $id_pago
 * @property int $id_reserva
 * @property int $id_servicio
 * @property int $id_suscripcion
 * @property int $id_membresia
 * @property int $subtotal
 * @property Membresium $membresium
 * @property Pago $pago
 * @property Reserva $reserva
 * @property ServicioPsicologo $servicioPsicologo
 * @property Suscripcion $suscripcion
 */
class DetallePago extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detalle_pago';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_detalle_pago';

    /**
     * @var array
     */
    protected $fillable = ['id_pago', 'id_reserva', 'id_servicio', 'id_suscripcion', 'id_membresia', 'subtotal', 'created_at', 'updated_at'];

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
    public function pago()
    {
        return $this->belongsTo('App\Pago', 'id_pago', 'id_pago');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reserva()
    {
        return $this->belongsTo('App\Reserva', 'id_reserva', 'id_reserva');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicioPsicologo()
    {
        return $this->belongsTo('App\ServicioPsicologo', 'id_servicio', 'idservicio_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function suscripcion()
    {
        return $this->belongsTo('App\Suscripcion', 'id_suscripcion', 'id_suscripcion');
    }
}
