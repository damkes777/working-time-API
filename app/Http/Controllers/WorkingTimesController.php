<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRegistrationRequest;
use App\Models\WorkingTime;
use App\Services\WorkingTimeService;
use Illuminate\Http\JsonResponse;

class WorkingTimesController
{
    public function timeRegistration(TimeRegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $workingTimeService = new WorkingTimeService();

            $startDay = $workingTimeService->getStartDay($validated['work_start']);

            if ($workingTimeService->workDayExist($validated['employee_uuid'], $startDay)) {

                return response()->json([
                    'message' => 'Time already registered for this day',
                ], 400);
            }

            if ($workingTimeService->workedMoreThanLimit($validated['work_start'], $validated['work_end'])) {

                return response()->json([
                    'message' => 'You cannot work more than 12 hours',
                ], 400);
            }

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