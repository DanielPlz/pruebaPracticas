<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\carbon;
use App\User;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'apellido', 
        'email', 
        'password', 
        'avatar', 
        'nickname',        
        'rut', 
        'telefono',
        'fecha_nacimiento',
        'tipo',
        'direccion',
        'comuna',
        'provider', 
        'provider_id',
        'remember_token',
        'edad',
        'ocupacion',
        'estudios',
        'estado',
        'tipo_alta',
        'fecha_egreso',
        'id_profesional',
        'created_at',
        'updated_at'                
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info()
    {
        return $this->hasOne('App\InfoProfesional');
    }

    public function servicios()
    {
        return $this->hasMany('App\Servicio');
    }

    public function testimonios()
    {
        return $this->hasMany('App\Testimonio', 'profesional_id');
    }




    public function comentario()
    {
        return $this->hasMany('App\Comentario');
    }
    public function post(){
        return $this->hasMany('App\Modelos\Foro\Post');

    }
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }
    


    // Comienzo funciones modificadas

    public function scopeName($query, $name)
    {
        if($name)
            return $query->where('name', 'LIKE', "%$name%");

    }

    public function scopeRut($query, $rut){
        if($rut)
                    return $query->where('rut', $rut);
    }
  
    public function scopeId($query, $id){
        if($id)
                    return $query->where('id',$id);
    }
      // Término funciones modificadas
    public function scopeEstado($query, $estado){
        if($estado)
                    return $query->where('estado','like',"%$estado%");
    }

    public function scopeFechaEgreso($query, $fecha_egreso){
        if($fecha_egreso)
            return $query->where('fecha_egreso','like',"%$fecha_egreso%");
            
        
    }
    
    public function diagnosticos(){

        return $this->hasMany('App\diagnosticomodel','id_paciente');

    }
    
    public function cita(){
        return $this->hasMany('App\Cita');
    }

    // Usada para para modulo de chat
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
