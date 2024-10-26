<?php

namespace App\Services;

use App\Interfaces\SalaryInterface;

class SalaryService implements SalaryInterface
{
    private float $normMonthly;

    public function __construct()
    {
        $this->normMonthly = config('salary.normMonthly');
    }

    public function calculateOvertime(float $hours, bool $daily = false): float
    {
        if ($daily) {
            if ($hours > 8) {
                return $hours - 8;
            }

            return 0;
        }

        if ($hours > $this->normMonthly) {
            return $hours - $this->normMonthly;
        }

        return 0;
    }

    public function calculateSalary(
        float $hours,
        float $rate,
        float $overtime,
        float $overtimeMultiplier,
        bool $daily = false
    ): float {
        if ($daily) {
            if ($overtime > 0) {

                return ($hours - $overtime) * $rate + $overtime * $rate * $overtimeMultiplier;
            }

            return $hours * $rate;
        }

        if ($hours > $this->normMonthly) {
            return $this->normMonthly * $rate + ($hours - $this->normMonthly) * $rate * $overtimeMultiplier;
        }

        return $hours * $rate;
    }
}