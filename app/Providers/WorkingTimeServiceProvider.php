<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\SalaryServiceInterface;
use App\Interfaces\WorkingTimeRepositoryInterface;
use App\Services\WorkingTime\WorkingTimeService;
use Illuminate\Support\ServiceProvider;

class WorkingTimeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(WorkingTimeService::class, function ($app) {
            return new WorkingTimeService(
                $app->make(WorkingTimeRepositoryInterface::class),
                $app->make(EmployeeRepositoryInterface::class),
                $app->make(SalaryServiceInterface::class),
            );
        });
    }

    public function boot(): void
    {
    }
}
