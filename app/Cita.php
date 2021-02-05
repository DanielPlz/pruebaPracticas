<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = "cita";
    protected $primary_key = "id";
    public $timestamps = false;

    protected $fillable = [
        'locacion', 
        'hora_inicio',
        'hora_termino',
        'fecha',
        'estado',
        'estado_pago',
        'modalidad',
        'descanso',
        'user_id',
        'servicio_id',
        'prevision',
        'isapre',
        'precio',
        'rut',
        'correo',
        'telefono'
    ];

    public function usuario(){
        return $this->belongsTo('App\User');
    }
    public function servicio(){
        return $this->belongsTo('App\Servicio');
    }
    

}
