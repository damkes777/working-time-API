<?php

namespace App\Interfaces;

interface SalaryServiceInterface
{
    public function calculateOvertime(float $hours): float;

    public function calculateMonthlySalary(float $hours): float;

    public function calculateDailySalary(float $hours): float;

    public function getRate(): float;

    public function getOvertimeMultiplier(): float;

    public function getCurrency(): string;
}