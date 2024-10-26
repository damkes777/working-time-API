<?php

namespace Tests\Unit;

use App\Services\SalaryService;
use Tests\TestCase;

class SalaryServiceTest extends TestCase
{
    public function test_calculate_overtime(): void
    {
        $salaryService = new SalaryService();
        $hours         = 40;
        $overTime      = $salaryService->calculateOvertime($hours);

        $this->assertEquals(0, $overTime);
    }

    public function test_calculate_overtime_with_overtime(): void
    {
        $salaryService = new SalaryService();
        $hours         = 50;
        $overTime      = $salaryService->calculateOvertime($hours);

        $this->assertEquals(10, $overTime);
    }

    public function test_calculate_daily_salary(): void
    {
        $salaryService = new SalaryService();
        $hours         = 8;

        $salary = $salaryService->calculateSalary(hours: $hours, daily: true);

        $this->assertEquals(160, $salary);
    }

    public function test_calculate_monthly_salary(): void
    {
        $salaryService = new SalaryService();
        $hours         = 40;
        $overtime      = 0;

        $salary = $salaryService->calculateSalary($hours, $overtime);

        $this->assertEquals(800, $salary);
    }

    public function test_calculate_monthly_salary_with_overtime(): void
    {
        $salaryService = new SalaryService();
        $hours         = 50;
        $overtime      = 10;

        $salary = $salaryService->calculateSalary($hours, $overtime);

        $this->assertEquals(1200, $salary);
    }
}