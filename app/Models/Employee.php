<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function workingTimes(): HasMany
    {
        return $this->hasMany(WorkingTime::class, 'employee_uuid', 'uuid');
    }
}