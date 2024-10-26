<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getMonthlyWorkingTime(string $date): float
    {
        $hours = $this->workingTimes()
                      ->whereMonth('work_day_start', Carbon::parse($date)
                                                           ->get('month'))
                      ->get()
                      ->sum('working_hours');

        return round($hours * 2) / 2;
    }

    public function getDailyWorkingTime(string $date): float
    {
        $workingTime = $this->workingTimes()
                      ->whereDate('work_day_start', $date)
                      ->first();

        return round($workingTime->working_hours * 2) / 2;
    }
}