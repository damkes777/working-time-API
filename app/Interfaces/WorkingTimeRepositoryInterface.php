<?php

namespace App\Interfaces;

use App\Models\WorkingTime;

interface WorkingTimeRepositoryInterface
{
    public function create(array $data): WorkingTime;

    public function workDayExist(string $employeeUuid, string $workDayStart): bool;
}