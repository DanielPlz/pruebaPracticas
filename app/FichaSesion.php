<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_sesion
 * @property int $id_reserva
 * @property int $id_servicio_profesional
 * @property int $id_psicologo
 * @property int $id_ficha
 * @property string $fecha
 * @property string $objetivo
 * @property string $descripcion
 * @property int $n_sesion
 * @property Ficha $ficha
 * @property Psicologo $psicologo
 * @property Reserva $reserva
 * @property ServicioPsicologo $servicioPsicologo
 * @property FichaCertificado[] $fichaCertificados
 * @property FichaObservacion[] $fichaObservacions
 */
class FichaSesion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ficha_sesion';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_sesion';

    /**
     * @var array
     */
    protected $fillable = ['id_reserva', 'id_servicio_profesional', 'id_psicologo', 'id_ficha', 'fecha', 'objetivo', 'descripcion', 'n_sesion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ficha()
    {
        return $this->belongsTo('App\Ficha', 'id_ficha', 'id_ficha');
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
    public function reserva()
    {
        return $this->belongsTo('App\Reserva', 'id_reserva', 'id_reserva');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicioPsicologo()
    {
        return $this->belongsTo('App\ServicioPsicologo', 'id_servicio_profesional', 'idservicio_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaCertificados()
    {
        return $this->hasMany('App\FichaCertificado', 'id_ficha_sesion', 'id_sesion');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaObservacions()
    {
        return $this->hasMany('App\FichaObservacion', 'id_sesion', 'id_sesion');
    }
}
