<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRegistrationRequest;
use App\Http\Requests\WorkingTimeSummaryRequest;
use App\Models\Employee;
use App\Models\WorkingTime;
use App\Services\SalaryService;
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

            try {
                WorkingTime::query()
                           ->create([
                               'employee_uuid' => $validated['employee_uuid'],
                               'work_start' => $validated['work_start'],
                               'work_end' => $validated['work_end'],
                               'work_day_start' => $startDay,
                           ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Time registration failed',
                ]);
            }

            return response()->json([
                'message' => 'Time registered successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Time registration failed',
            ]);
        }
    }

    public function workingTimeSummary(WorkingTimeSummaryRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $employee  = Employee::query()
                             ->where('uuid', $validated['employee_uuid'])
                             ->first();

        $salaryService      = new SalaryService();
        $rate               = $salaryService->getRate();
        $overtimeMultiplier = $salaryService->getOvertimeMultiplier();
        $currency           = $salaryService->getCurrency();

        if (Carbon::hasFormat($validated['date'], 'Y-m')) {
            $workingTime = $employee->getMonthlyWorkingTime($validated['date']);
            $overtime    = $salaryService->calculateOvertime($workingTime);
            $salary      = $salaryService->calculateSalary($workingTime, $overtime);

            return response()->json([
                'number of hours a given month' => $workingTime,
                'rate' => $rate . ' ' . $currency,
                'the number of overtime hours in a given month' => $overtime,
                'overtime rate' => $rate * $overtimeMultiplier . ' ' . $currency,
                'total salary' => $salary,
            ]);
        }

        if (Carbon::hasFormat($validated['date'], 'Y-m-d')) {
            $workingTime = $employee->getDailyWorkingTime($validated['date']);
            $salary      = $salaryService->calculateSalary(hours: $workingTime, daily: true);

            return response()->json([
                'number of hours a given day' => $workingTime,
                'rate' => $rate . ' ' . $currency,
                'total salary' => $salary,
            ]);
        }

        return response()->json([
            'message' => 'Invalid date format',
        ], 400);
    }
}