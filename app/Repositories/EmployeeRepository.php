<?php

namespace App\Repositories;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function create(array $data): Employee
    {
        return Employee::query()
                       ->create($data);
    }

    public function findByUuid(string $uuid): Employee
    {
        return Employee::query()
                       ->where('uuid', '=', $uuid)
                       ->firstOrFail();
    }
}