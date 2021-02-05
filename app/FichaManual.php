<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_ficha_manual
 * @property string $nombre
 * @property string $copyright
 * @property FichaEjeManual[] $fichaEjeManuals
 */
class FichaManual extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ficha_manual';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_ficha_manual';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'copyright', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaEjeManuals()
    {
        return $this->hasMany('App\FichaEjeManual', 'id_ficha_manual', 'id_ficha_manual');
    }
}
