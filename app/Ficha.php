<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_ficha
 * @property int $id_diag_gene
 * @property int $id_diag_por_eje
 * @property string $tipo_alta
 * @property string $descripcion
 * @property int $id_paciente
 * @property int $id_carga
 * @property FichaDiagnosticoGeneral $fichaDiagnosticoGeneral
 * @property FichaDiagnosticoPorEje $fichaDiagnosticoPorEje
 * @property FichaSesion[] $fichaSesions
 */
class Ficha extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ficha';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_ficha';

    /**
     * @var array
     */
    protected $fillable = ['id_diag_gene', 'id_diag_por_eje', 'tipo_alta', 'descripcion', 'id_paciente', 'id_carga', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichaDiagnosticoGeneral()
    {
        return $this->belongsTo('App\FichaDiagnosticoGeneral', 'id_diag_gene', 'id_diag_gene');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichaDiagnosticoPorEje()
    {
        return $this->belongsTo('App\FichaDiagnosticoPorEje', 'id_diag_por_eje', 'id_diag_por_eje');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaSesions()
    {
        return $this->hasMany('App\FichaSesion', 'id_ficha', 'id_ficha');
    }
}
