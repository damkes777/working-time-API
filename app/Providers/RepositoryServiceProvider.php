<?php

namespace App\Providers;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
    }

    public function boot(): void
    {
    }
}
