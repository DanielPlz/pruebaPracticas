<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $provider
 * @property string $provider_id
 * @property string $avatar
 * @property string $email_verified_at
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Paciente[] $pacientes
 * @property Pago[] $pagos
 * @property Psicologo[] $psicologos
 * @property UsuarioRol[] $usuarioRols
 */
class User extends Authenticatable 
{
    use Notifiable;
    /**
     * @var array
     */
    protected $fillable = ['email', 'password', 'provider', 'provider_id', 
    'avatar', 'email_verified_at', 'remember_token', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pacientes()
    {
        return $this->hasMany('App\Paciente', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagos()
    {
        return $this->hasMany('App\Pago', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function psicologos()
    {
        return $this->hasMany('App\Psicologo', 'id_user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usuarioRols()
    {
        return $this->hasMany('App\UsuarioRol', 'id_user');
    }
}
