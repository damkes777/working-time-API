<?php

namespace App\Providers;

use App\Interfaces\SalaryServiceInterface;
use App\Services\SalaryService;
use Illuminate\Support\ServiceProvider;

class SalaryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(SalaryServiceInterface::class, SalaryService::class);
    }

    public function boot(): void
    {
    }
}
