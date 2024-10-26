<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRegistrationRequest;
use App\Models\WorkingTime;
use App\Services\WorkingTimeService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class WorkingTimesController
{
    public function timeRegistration(TimeRegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $workingTimeService = new WorkingTimeService();

            $startDay = $workingTimeService->getStartDay($validated['work_start']);

            WorkingTime::query()
                       ->create([
                           'employee_uuid' => $validated['employee_uuid'],
                           'work_start' => $validated['work_start'],
                           'work_end' => $validated['work_end'],
                           'work_day_start' => $startDay,
                       ]);

            return response()->json([
                'message' => 'Time registered successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Time registration failed',
            ]);
        }
    }
}