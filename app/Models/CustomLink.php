<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $url_destination
 * @property string $ancre
 * @property string $url_ajout
 * @property string $created_at
 * @property string $updated_at
 */
class CustomLink extends Model
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
    protected $fillable = ['url_destination', 'ancre', 'url_ajout', 'created_at', 'updated_at'];
}
