<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idservicio_psicologo
 * @property int $id_psicologo
 * @property int $id_servicio
 * @property int $id_horario
 * @property string $duracion
 * @property boolean $estado_servicio
 * @property int $precio_particular
 * @property Horario $horario
 * @property Psicologo $psicologo
 * @property Servicio $servicio
 * @property DetallePago[] $detallePagos
 * @property FichaSesion[] $fichaSesions
 * @property ModalidadServicio[] $modalidadServicios
 * @property Reserva[] $reservas
 */
class ServicioPsicologo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servicio_psicologo';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_servicio_psicologo';

    /**
     * @var array
     */
    protected $fillable = ['id_psicologo', 'id_servicio', 'id_horario', 'duracion', 'estado_servicio', 'precio_particular', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function horario()
    {
        return $this->belongsTo('App\Horario', 'id_horario', 'id_horario');
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
    public function servicio()
    {
        return $this->belongsTo('App\Servicio', 'id_servicio', 'id_servicio');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detallePagos()
    {
        return $this->hasMany('App\DetallePago', 'id_servicio', 'idservicio_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaSesions()
    {
        return $this->hasMany('App\FichaSesion', 'id_servicio_profesional', 'idservicio_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modalidadServicios()
    {
        return $this->hasMany('App\ModalidadServicio', 'id_servicio_psicologo', 'idservicio_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservas()
    {
        return $this->hasMany('App\Reserva', 'id_servicio_psicologo', 'idservicio_psicologo');
    }
}
