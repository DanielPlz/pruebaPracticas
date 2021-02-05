<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_paciente
 * @property int $id_user
 * @property int $id_persona
 * @property string $escolaridad
 * @property string $ocupacion
 * @property string $estado_civil
 * @property string $grupo_familiar
 * @property string $estado_clinico
 * @property string $tipo_alta
 * @property string $tipo_paciente
 * @property string $created_at
 * @property string $updated_at
 * @property Persona $persona
 * @property User $user
 * @property Reserva[] $reservas
 * @property Testimonio[] $testimonios
 */
class Paciente extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'paciente';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_paciente';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_persona', 'escolaridad', 'ocupacion', 'estado_civil', 'grupo_familiar',
     'estado_clinico', 'tipo_alta', 'tipo_paciente', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'id_persona', 'id_persona');
    }

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
    public function reservas()
    {
        return $this->hasMany('App\Reserva', 'id_paciente', 'id_paciente');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testimonios()
    {
        return $this->hasMany('App\Testimonio', 'id_paciente', 'id_paciente');
    }

    public static function datosPersonales($id)
    {
        return Paciente::select(
            'persona.nombre',
            'persona.apellido_paterno',
            'persona.apellido_materno'
        )
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'paciente.id_user');
            })
            ->join('persona', function ($join) {
                $join->on('paciente.id_persona', '=', 'persona.id_persona');
            })
            ->where('id_user', $id)
            ->first();
    }
}
