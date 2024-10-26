<?php

namespace App\Services;

use App\Interfaces\SalaryInterface;

class SalaryService implements SalaryInterface
{
    private float $normMonthly;
    private float $rate;
    private float $overtimeMultiplier;
    private string $currency;

    public function __construct()
    {
        $this->normMonthly        = config('salary.normMonthly');
        $this->rate               = config('salary.hourlyRate');
        $this->overtimeMultiplier = config('salary.overtimeMultiplier');
        $this->currency           = config('salary.currency');
    }

    public function calculateOvertime(float $hours): float
    {
        if ($hours > $this->normMonthly) {
            return $hours - $this->normMonthly;
        }

        return 0;
    }

    public function calculateSalary(
        float $hours,
        float $overtime = 0,
        bool $daily = false
    ): float {
        if ($daily) {
            return $hours * $this->rate;
        }

        if ($hours > $this->normMonthly) {
            return $this->normMonthly * $this->rate +
                   ($hours - $this->normMonthly) * $this->rate * $this->overtimeMultiplier;
        }

        return $hours * $this->rate;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getOvertimeMultiplier(): float
    {
        return $this->overtimeMultiplier;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}