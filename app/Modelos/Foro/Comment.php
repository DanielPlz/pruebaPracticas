<?php

namespace App\Modelos\Foro;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='foro_comment';
    protected $fillable=['comment','post_id','users_id'];
    public function user()
    {
        return $this->belongsTo('App\User','users_id');

    }
    public function post()
    {
        return $this->belongsTo('App\Modelos\Foro\Post','post_id');
    }
}
