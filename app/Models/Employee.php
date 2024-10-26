<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $uuid
 * @property string $name
 * @property string $last_name
 */
class Employee extends Model
{
    protected $fillable = [
        'uuid',
        'name',
        'last_name',
    ];
}