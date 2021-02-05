<?php

namespace App\Modelos\Foro;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table='foro_likes';
    protected $primaryKey = 'id';
    protected $fillable=[
        'like','post_id','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','users_id');

    }
    public function post()
    {
        return $this->belongsTo('App\Modelos\Foro\Post','post_id');

    }
}
