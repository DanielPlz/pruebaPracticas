<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_ficha_eje_manual
 * @property int $id_ficha_manual
 * @property string $nombre
 * @property string $descripcion
 * @property FichaManual $fichaManual
 * @property FichaDiagnosticoEje[] $fichaDiagnosticoEjes
 */
class FichaEjeManual extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ficha_eje_manual';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_ficha_eje_manual';

    /**
     * @var array
     */
    protected $fillable = ['id_ficha_manual', 'nombre', 'descripcion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichaManual()
    {
        return $this->belongsTo('App\FichaManual', 'id_ficha_manual', 'id_ficha_manual');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaDiagnosticoEjes()
    {
        return $this->hasMany('App\FichaDiagnosticoEje', 'id_ficha_eje_manual', 'id_ficha_eje_manual');
    }
}
