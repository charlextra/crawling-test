<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $url
 * @property int $status
 * @property string $path
 * @property string $created_at
 * @property string $updated_at
 */
class Crawler extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['url', 'status', 'path', 'created_at', 'updated_at'];
}
