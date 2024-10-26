<?php

namespace App\Interfaces;

interface SalaryInterface
{
    public function calculateOvertime(float $hours): float;

    public function calculateSalary(
        float $hours,
        float $overtime = 0,
        bool $daily = false
    ): float;

    public function getRate(): float;

    public function getOvertimeMultiplier(): float;

    public function getCurrency(): string;
}