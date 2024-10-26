<?php

namespace App\Interfaces;

interface SalaryInterface
{
    public function calculateOvertime(
        float $hours,
        bool $daily = false)
    : float;

    public function calculateSalary(
        float $hours,
        float $rate,
        float $overtime,
        float $overtimeMultiplier,
        bool $daily = false
    ): float;
}