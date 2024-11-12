<?php

namespace Tests\Unit;

use App\Services\SalaryService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Tests\TestCase;

class SalaryServiceTest extends TestCase
{
    /**
     * @throws BindingResolutionException
     */
    public function test_calculate_overtime(): void
    {
        $salaryService = $this->app->make(SalaryService::class);
        $hours         = 40;
        $overTime      = $salaryService->calculateOvertime($hours);

        $this->assertEquals(0, $overTime);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_calculate_overtime_with_overtime(): void
    {
        $salaryService = $this->app->make(SalaryService::class);
        $hours         = 50;
        $overTime      = $salaryService->calculateOvertime($hours);

        $this->assertEquals(10, $overTime);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_calculate_daily_salary(): void
    {
        $salaryService = $this->app->make(SalaryService::class);
        $hours         = 8;

        $salary = $salaryService->calculateDailySalary(hours: $hours);

        $this->assertEquals(160, $salary);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_calculate_monthly_salary(): void
    {
        $salaryService = $this->app->make(SalaryService::class);
        $hours         = 40;

        $salary = $salaryService->calculateMonthlySalary($hours);

        $this->assertEquals(800, $salary);
    }

    /**
     * @throws BindingResolutionException
     */
    public function test_calculate_monthly_salary_with_overtime(): void
    {
        $salaryService = $this->app->make(SalaryService::class);
        $hours         = 50;

        $salary = $salaryService->calculateMonthlySalary($hours);

        $this->assertEquals(1200, $salary);
    }
}