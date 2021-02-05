<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_pago
 * @property int $id_user
 * @property string $orden_compra
 * @property int $monto
 * @property int $cod_autorizacion
 * @property string $fecha
 * @property string $tipo_pago
 * @property string $tipo_cuota
 * @property int $cantidad_cuotas
 * @property int $monto_cuota
 * @property int $numero_tarjeta
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property DetallePago[] $detallePagos
 */
class Pago extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pago';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_pago';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'orden_compra', 'monto', 'cod_autorizacion', 'fecha', 'tipo_pago', 'tipo_cuota', 'cantidad_cuotas', 'monto_cuota', 'numero_tarjeta', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePagos()
    {
        return $this->hasMany('App\DetallePago', 'id_pago', 'id_pago');
    }
}
