<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class EmployeesController
{
    public function create(EmployeeCreateRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $uuid = Str::uuid();
            Employee::query()
                    ->create([
                        'uuid' => $uuid,
                        'name' => $validated['name'],
                        'last_name' => $validated['last_name'],
                    ]);

            return response()->json([
                'message' => 'Employee created successfully with uuid: ' . $uuid,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Employee creation failed',
            ]);
        }
    }
}