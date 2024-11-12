<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Services\Employee\EmployeeService;
use Illuminate\Support\ServiceProvider;

class EmployeeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EmployeeService::class, function ($app) {
            return new EmployeeService($app->make(EmployeeRepositoryInterface::class));
        });
    }

    public function boot(): void
    {
    }
}
