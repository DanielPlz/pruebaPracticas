<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_psicologo
 * @property int $id_user
 * @property int $id_persona
 * @property string $titulo
 * @property string $especialidad
 * @property string $descripcion
 * @property string $casa_academica
 * @property string $grado_academico
 * @property string $fecha_egreso
 * @property int $experiencia
 * @property string $imagen_titulo
 * @property string $verificacion
 * @property string $created_at
 * @property string $updated_at
 * @property Persona $persona
 * @property User $user
 * @property FichaSesion[] $fichaSesions
 * @property Historial[] $historials
 * @property Horario[] $horarios
 * @property ServicioPsicologo[] $servicioPsicologos
 * @property Testimonio[] $testimonios
 */
class Psicologo extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'psicologo';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_psicologo';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_persona', 'titulo', 'especialidad', 'descripcion', 'casa_academica',
     'grado_academico', 'fecha_egreso', 'experiencia', 'imagen_titulo', 'verificacion', 'created_at', 'updated_at'];

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
    public function fichaSesions()
    {
        return $this->hasMany('App\FichaSesion', 'id_psicologo', 'id_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historials()
    {
        return $this->hasMany('App\Historial', 'id_psicologo', 'id_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horarios()
    {
        return $this->hasMany('App\Horario', 'id_psicologo', 'id_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function servicioPsicologos()
    {
        return $this->hasMany('App\ServicioPsicologo', 'id_psicologo', 'id_psicologo');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function testimonios()
    {
        return $this->hasMany('App\Testimonio', 'id_psicologo', 'id_psicologo');
    }
}
