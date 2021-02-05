<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_horario
 * @property int $id_psicologo
 * @property string $hora_inicio
 * @property string $hora_almuerzo
 * @property string $hora_termino
 * @property Psicologo $psicologo
 * @property ServicioPsicologo[] $servicioPsicologos
 */
class Horario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'horario';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_horario';

    /**
     * @var array
     */
    protected $fillable = ['id_psicologo', 'hora_inicio', 'hora_almuerzo', 'hora_termino', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function psicologo()
    {
        return $this->belongsTo('App\Psicologo', 'id_psicologo', 'id_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicioPsicologos()
    {
        return $this->hasMany('App\ServicioPsicologo', 'id_horario', 'id_horario');
    }
}
