<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_sala
 * @property int $id_centro
 * @property string $created_at
 * @property Centro $centro
 */
class Sala extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sala';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_sala';

    /**
     * @var array
     */
    protected $fillable = ['id_centro', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function centro()
    {
        return $this->belongsTo('App\Centro', 'id_centro', 'id_centro');
    }
}
