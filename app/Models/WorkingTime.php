<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $appends = ['working_hours'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_uuid', 'uuid');
    }

    public function workingHours(): Attribute
    {
        return new Attribute(get: function () {
            $startTime = Carbon::parse($this->work_start);;
            $endTime = Carbon::parse($this->work_end);

            return $startTime->diffInHours($endTime);
        });
    }
}