<?php

namespace App\Services;

use App\Interfaces\SalaryInterface;

class SalaryService implements SalaryInterface
{

    public function calculateOvertime(float $hours, bool $daily = false): float
    {
        // TODO: Implement calculateOvertime() method.
    }

    public function calculateSalary(
        float $hours,
        float $rate,
        float $overtime,
        float $overtimeMultiplier,
        bool $daily = false
    ): float {
        // TODO: Implement calculateSalary() method.
    }
}