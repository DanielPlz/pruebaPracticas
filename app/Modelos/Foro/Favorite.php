<?php
//namespace correspondiente a su ubicacion en carpeta
namespace App\Modelos\Foro;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table='foro_favorite';
    protected $primaryKey = 'id';
    protected $fillable=[
        'post_id','users_id'
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
