<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_ficha_certificado
 * @property int $id_ficha_sesion
 * @property string $certificado
 * @property string $tipo_certificado
 * @property string $fecha_certificado
 * @property FichaSesion $fichaSesion
 */
class FichaCertificado extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ficha_certificado';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_ficha_certificado';

    /**
     * @var array
     */
    protected $fillable = ['id_ficha_sesion', 'certificado', 'tipo_certificado', 'fecha_certificado', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fichaSesion()
    {
        return $this->belongsTo('App\FichaSesion', 'id_ficha_sesion', 'id_sesion');
    }
}
