<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_centro
 * @property string $nombre
 * @property ModalidadServicio[] $modalidadServicios
 * @property Sala[] $salas
 */
class Centro extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'centro';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_centro';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modalidadServicios()
    {
        return $this->hasMany('App\ModalidadServicio', 'id_centro', 'id_centro');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function salas()
    {
        return $this->hasMany('App\Sala', 'id_centro', 'id_centro');
    }
}
