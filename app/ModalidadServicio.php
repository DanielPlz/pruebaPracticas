<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_modalidad_servicio
 * @property int $id_centro
 * @property int $id_servicio_psicologo
 * @property int $presencial
 * @property int $online
 * @property int $visita
 * @property Centro $centro
 * @property ServicioPsicologo $servicioPsicologo
 */
class ModalidadServicio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'modalidad_servicio';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_modalidad_servicio';

    /**
     * @var array
     */
    protected $fillable = ['id_centro', 'id_servicio_psicologo', 'presencial', 'online', 'visita', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centro()
    {
        return $this->belongsTo('App\Centro', 'id_centro', 'id_centro');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicioPsicologo()
    {
        return $this->belongsTo('App\ServicioPsicologo', 'id_servicio_psicologo', 'idservicio_psicologo');
    }
}
