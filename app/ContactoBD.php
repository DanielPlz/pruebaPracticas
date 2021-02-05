<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactoBD extends Model
{    

    protected $table = "contactobd";
    public $timestamps = false;

    protected $fillable = [
        'rut',
        'tipo_us', 
        'nombre_cont_us',
        'apellido_cont_us',
        'telefono_cont_us',
        'correo_cont_us',
        'region_cont_us',
        'comuna_cont_us',
        'calle_cont_us',
        'no_casa_cont_us',
        'no_depto_cont_us'  
    ];   


}
