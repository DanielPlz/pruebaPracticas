<?php

namespace App\Modelos\Foro;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table='foro_post';
    protected $primaryKey = 'id';

    protected $fillable=[
        'titulo','contenido','categoria_id','user_id', 'imagen'
    ];

    public function comentarios(){
        return $this->hasMany('App\Modelos\Foro\Comment');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Modelos\Foro\Categoria','categoria_id');

    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');

    }
    public function likes()
    {
        return $this->hasMany('App\Modelos\Foro\Like');
    }
}
