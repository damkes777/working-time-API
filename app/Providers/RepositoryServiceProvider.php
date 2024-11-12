<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\WorkingTimeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use App\Repositories\WorkingTimeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(WorkingTimeRepositoryInterface::class, WorkingTimeRepository::class);
    }

    public function boot(): void
    {
    }
}
