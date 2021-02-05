<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_persona
 * @property string $rut
 * @property string $nombre
 * @property string $apellido_paterno
 * @property string $apellido_materno
 * @property string $fecha_nacimiento
 * @property string $genero
 * @property string $telefono
 * @property string $direccion
 * @property string $comuna
 * @property string $region
 * @property string $created_at
 * @property string $updated_at
 * @property Paciente[] $pacientes
 * @property Psicologo[] $psicologos
 */
class Persona extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'persona';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_persona';

    /**
     * @var array
     */
    protected $fillable = ['rut', 'nombre', 'apellido_paterno', 'apellido_materno', 'fecha_nacimiento', 'genero', 'telefono', 'direccion', 'comuna', 'region', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Paciente', 'id_persona', 'id_persona');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function psicologos()
    {
        return $this->hasMany('App\Psicologo', 'id_persona', 'id_persona');
    }
}
