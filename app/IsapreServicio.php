<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IsapreServicio extends Model
{
    protected $table = "isapre_servicio";
    protected $primary_key = "id";
    public $timestamps = false;

    protected $fillable = [
        'id',
        'banmedica',
        'consalud',
        'colmena',
        'cruzblanca',
        'masvida',
        'vidatres',
        'servicio_id',
    ];
}
