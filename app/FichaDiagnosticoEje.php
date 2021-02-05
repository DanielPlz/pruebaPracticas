<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_ficha_diag_eje
 * @property int $id_ficha_eje_manual
 * @property string $descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property FichaEjeManual $fichaEjeManual
 * @property FichaDiagnosticoPorEje[] $fichaDiagnosticoPorEjes
 */
class FichaDiagnosticoEje extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ficha_diagnostico_eje';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_ficha_diag_eje';

    /**
     * @var array
     */
    protected $fillable = ['id_ficha_eje_manual', 'descripcion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichaEjeManual()
    {
        return $this->belongsTo('App\FichaEjeManual', 'id_ficha_eje_manual', 'id_ficha_eje_manual');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaDiagnosticoPorEjes()
    {
        return $this->hasMany('App\FichaDiagnosticoPorEje', 'id_ficha_diag_eje', 'id_ficha_diag_eje');
    }
}
