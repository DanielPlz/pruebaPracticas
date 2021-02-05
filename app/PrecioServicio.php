<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrecioServicio extends Model
{
    protected $table = "precio_servicio";
    protected $primary_key = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'precioFonasa',
        'precioIsapre',
        'precioParticular',
        'servicio_id',
    ];
}
