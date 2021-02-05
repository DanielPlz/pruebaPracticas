<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $centro_id
 * @property string $fecha
 */
class CentroUsers extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'centro_id', 'fecha', 'created_at', 'updated_at'];
}
