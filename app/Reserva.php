<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_reserva
 * @property int $id_paciente
 * @property int $id_servicio_psicologo
 * @property string $nro_reserva
 * @property string $fecha
 * @property string $hora_inicio
 * @property string $hora_termino
 * @property string $confirmacion
 * @property int $precio
 * @property string $estado_pago
 * @property Paciente $paciente
 * @property ServicioPsicologo $servicioPsicologo
 * @property DetallePago[] $detallePagos
 * @property FichaSesion[] $fichaSesions
 */
class Reserva extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reserva';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_reserva';

    /**
     * @var array
     */
    protected $fillable = ['id_paciente', 'id_servicio_psicologo', 'nro_reserva', 'fecha', 'hora_inicio', 'hora_termino', 'confirmacion', 'precio', 'estado_pago', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paciente()
    {
        return $this->belongsTo('App\Paciente', 'id_paciente', 'id_paciente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicioPsicologo()
    {
        return $this->belongsTo('App\ServicioPsicologo', 'id_servicio_psicologo', 'idservicio_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePagos()
    {
        return $this->hasMany('App\DetallePago', 'id_reserva', 'id_reserva');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaSesions()
    {
        return $this->hasMany('App\FichaSesion', 'id_reserva', 'id_reserva');
    }
}
