<?php

namespace App\Repositories;

use App\Interfaces\WorkingTimeRepositoryInterface;
use App\Models\WorkingTime;

class WorkingTimeRepository implements WorkingTimeRepositoryInterface
{

    public function create(array $data): WorkingTime
    {
        return WorkingTime::query()
                          ->create($data);
    }

    public function workDayExist(string $employeeUuid, string $workDayStart): bool
    {
        return WorkingTime::query()
                          ->where('employee_uuid', $employeeUuid)
                          ->where('work_day_start', $workDayStart)
                          ->exists();
    }
}