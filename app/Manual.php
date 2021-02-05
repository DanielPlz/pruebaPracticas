<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    protected $table='manual';
    protected $primary_key='id';
    protected $fillable=[
        'id',
        'tipo_manual',
        'eje1',
        'eje2',
        'eje3',
        'eje4',
        'eje5',
        'eje6',
        'created_at',
        'updated_at',
    ];
}
