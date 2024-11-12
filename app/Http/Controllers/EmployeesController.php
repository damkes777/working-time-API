<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Services\Employee\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class EmployeesController
{
    public function __construct(
        protected EmployeeService $employeeService
    ) {
    }

    public function create(EmployeeCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $message = $this->employeeService->create($validated);

        return response()->json($message);
    }
}