<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//clase modelo donde se definen las tablas con las que se trabaja
class Pago extends Model
{

    protected $table = "pago_paciente";
    protected $primary_key = 'id';

    protected $fillable = [
        'fecha', 'tipo_pago', 'monto', 'cita_id', 'user_id', 'ordendecompra', 'cod_autorizacion', 'cuotas', 'tipo_cuota', 'numerodetarjeta', 'fechaexpiraciontarjeta'
    ];
}
