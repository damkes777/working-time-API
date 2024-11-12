<?php

namespace App\Interfaces;

use App\Models\Employee;

interface EmployeeRepositoryInterface
{
    public function create(array $data): Employee;

    public function findByUuid(string $uuid): Employee;
}