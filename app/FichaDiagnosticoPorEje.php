<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_diag_por_eje
 * @property int $id_ficha_diag_eje
 * @property string $created_at
 * @property string $updated_at
 * @property FichaDiagnosticoEje $fichaDiagnosticoEje
 * @property Ficha[] $fichas
 */
class FichaDiagnosticoPorEje extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ficha_diagnostico_por_eje';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_diag_por_eje';

    /**
     * @var array
     */
    protected $fillable = ['id_ficha_diag_eje', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichaDiagnosticoEje()
    {
        return $this->belongsTo('App\FichaDiagnosticoEje', 'id_ficha_diag_eje', 'id_ficha_diag_eje');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichas()
    {
        return $this->hasMany('App\Ficha', 'id_diag_por_eje', 'id_diag_por_eje');
    }
}
