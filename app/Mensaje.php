<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property integer $from
 * @property integer $to
 * @property string $message
 * @property boolean $is_read
 * @property string $created_at
 * @property string $updated_at
 */
class Mensaje extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'mensaje';

    /**
     * @var array
     */
    protected $fillable = ['from', 'to', 'message', 'is_read', 'created_at', 'updated_at'];

}
