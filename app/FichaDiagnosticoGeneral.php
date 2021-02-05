<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_diag_gene
 * @property string $diag_gral
 * @property string $created_at
 * @property string $updated_at
 * @property Ficha[] $fichas
 */
class FichaDiagnosticoGeneral extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ficha_diagnostico_general';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_diag_gene';

    /**
     * @var array
     */
    protected $fillable = ['diag_gral', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichas()
    {
        return $this->hasMany('App\Ficha', 'id_diag_gene', 'id_diag_gene');
    }
}
