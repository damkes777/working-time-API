<?php

namespace App\Services;

use App\Interfaces\WorkingTimeInterface;
use App\Models\WorkingTime;
use Carbon\Carbon;

class WorkingTimeService implements WorkingTimeInterface
{
    private const MAX_WORK_TIME = 12;

    public function getStartDay(string $workStartTime): string
    {
        return Carbon::parse($workStartTime)
                     ->format('Y-m-d');
    }

    public function workDayExist(string $employeeUuid, string $workDayStart): bool
    {
        return WorkingTime::query()
                          ->where('employee_uuid', $employeeUuid)
                          ->where('work_day_start', $workDayStart)
                          ->exists();
    }

    public function workedMoreThanLimit(string $workStart, string $workEnd): bool
    {
        $startTime = Carbon::parse($workStart);
        $endTime = Carbon::parse($workEnd);

        $workTime = $startTime->diffInHours($endTime);

        return $workTime >= self::MAX_WORK_TIME;
    }
}
