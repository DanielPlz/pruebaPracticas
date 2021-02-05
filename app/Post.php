<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='post';
    protected $primaryKey = 'id';
    public $timestamps=false;

    protected $fillable=[
        'titulo',
        'contenido',
        'imagen',
        'created_at',
        'estado',
        'categoria_id',
        'user_id'
    ];

    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Categoria','categoria_id');

    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
}
