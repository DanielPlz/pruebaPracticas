<?php

namespace App\Modelos\Foro;

use Illuminate\Database\Eloquent\Model;

class LikeCmt extends Model
{
    protected $table='foro_likescmt';
    protected $primaryKey = 'id';
    protected $fillable=[
        'like','comment_id','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User','users_id');

    }
    public function comment()
    {
        return $this->belongsTo('App\Modelos\Foro\Comment','comment_id');

    }
}