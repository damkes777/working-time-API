<?php

namespace App\Services\Employee;

use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Str;

class EmployeeService
{
    public function __construct(
        protected EmployeeRepositoryInterface $employeeRepository
    ) {
    }

    public function create(array $data): array
    {
        try {
            $data['uuid'] = Str::uuid();
            $employee = $this->employeeRepository->create($data);

            return [
                'message' => 'Employee created successfully with uuid: ' . $employee->uuid,
            ];
        } catch (\Exception $exception) {
            return [
                'message' => 'Employee creation failed with exception: ' . $exception->getMessage(),
            ];
        }
    }

}