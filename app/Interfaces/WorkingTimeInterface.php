<?php

namespace App\Interfaces;

interface WorkingTimeInterface
{
    public function getStartDay(string $workStartTime): string;

    public function workDayExist(string $employeeUuid, string $workDayStart): bool;

    public function workedMoreThanLimit(string $workStart, string $workEnd): bool;
}