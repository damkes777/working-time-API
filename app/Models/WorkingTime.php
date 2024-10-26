<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $employee_uuid
 * @property string $work_start
 * @property string $work_end
 * @property string $work_day_start
 */
class WorkingTime extends Model
{
    protected $fillable = [
        'employee_uuid',
        'work_start',
        'work_end',
        'work_day_start'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_uuid', 'uuid');
    }
}