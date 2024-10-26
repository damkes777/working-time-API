<?php

namespace Tests\Unit;

use App\Services\SalaryService;
use Tests\TestCase;

class SalaryServiceTest extends TestCase
{
    public function test_calculate_daily_salary(): void
    {
        $salaryService      = new SalaryService();
        $rate               = config('salary.hourlyRate');
        $overtimeMultiplier = config('salary.overtimeMultiplier');
        $hours              = 8;
        $overtime           = 0;

        $salary = $salaryService->calculateSalary($hours, $rate, $overtime, $overtimeMultiplier, true);

        $this->assertEquals(160, $salary);
    }

    public function test_calculate_daily_salary_with_overtime(): void
    {
        $salaryService      = new SalaryService();
        $rate               = config('salary.hourlyRate');
        $overtimeMultiplier = config('salary.overtimeMultiplier');
        $hours              = 10;
        $overtime           = 2;

        $salaryService->calculateSalary($hours, $rate, $overtime, $overtimeMultiplier, true);
    }

    public function test_calculate_monthly_salary(): void
    {
        $salaryService      = new SalaryService();
        $rate               = config('salary.hourlyRate');
        $overtimeMultiplier = config('salary.overtimeMultiplier');
        $hours              = 40;
        $overtime           = 0;

        $salary = $salaryService->calculateSalary($hours, $rate, $overtime, $overtimeMultiplier);

        $this->assertEquals(800, $salary);
    }

    public function test_calculate_monthly_salary_with_overtime(): void
    {
        $salaryService      = new SalaryService();
        $rate               = config('salary.hourlyRate');
        $overtimeMultiplier = config('salary.overtimeMultiplier');
        $hours              = 50;
        $overtime           = 10;

        $salary = $salaryService->calculateSalary($hours, $rate, $overtime, $overtimeMultiplier);

        $this->assertEquals(1200, $salary);
    }
}