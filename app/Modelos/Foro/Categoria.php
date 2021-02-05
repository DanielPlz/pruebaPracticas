<?php

namespace App\Modelos\Foro;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='foro_categoria';
    protected $primary_key='id';
    protected $fillable=['titulo','descripcion'];

    public function posts(){
        return $this->hasMany('App\Modelos\Foro\Post');
    }
}
