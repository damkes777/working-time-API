<?php

namespace App\Services\WorkingTime;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\SalaryServiceInterface;
use App\Interfaces\WorkingTimeRepositoryInterface;
use Carbon\Carbon;

class WorkingTimeService
{
    private const MAX_WORK_TIME = 12;

    public function __construct(
        protected WorkingTimeRepositoryInterface $workingTimeRepository,
        protected EmployeeRepositoryInterface $employeeRepository,
        protected SalaryServiceInterface $salaryService,
    ) {
    }

    public function registerTime(array $data): array
    {
        $startDay     = $this->getStartDay($data['work_start']);
        $employeeUuid = $data['employee_uuid'];

        if ($this->workingTimeRepository->workDayExist($employeeUuid, $startDay)) {
            return [
                'message' => __('Time already registered for this day'),
            ];
        }

        if ($this->workedMoreThanLimit($data['work_start'], $data['work_end'])) {
            return [
                'message' => __('You cannot work more than 12 hours'),
            ];
        }

        try {
            $data['work_day_start'] = $startDay;
            $this->workingTimeRepository->create($data);

            return [
                'message' => __('Time registered successfully'),
            ];
        } catch (\Exception $exception) {
            return [
                'message' => __('Time registration failed witch exception: ') . $exception->getMessage(),
            ];
        }
    }

    private function getStartDay(string $workStartTime): string
    {
        return Carbon::parse($workStartTime)
                     ->format('Y-m-d');
    }

    private function workedMoreThanLimit(string $workStart, string $workEnd): bool
    {
        $startTime = Carbon::parse($workStart);
        $endTime   = Carbon::parse($workEnd);

        $workTime = $startTime->diffInHours($endTime);

        return $workTime >= self::MAX_WORK_TIME;
    }

    public function summaryWorkingTime(array $data): array
    {
        $employee = $this->employeeRepository->findByUuid($data['employee_uuid']);

        $rate               = $this->salaryService->getRate();
        $currency           = $this->salaryService->getCurrency();
        $overtimeMultiplier = $this->salaryService->getOvertimeMultiplier();

        if (Carbon::hasFormat($data['date'], 'Y-m')) {
            $workingTime = $employee->getMonthlyWorkingTime($data['date']);
            $overtime    = $this->salaryService->calculateOvertime($workingTime);
            $salary      = $this->salaryService->calculateMonthlySalary($workingTime);

            return [
                'number of hours a given month' => $workingTime,
                'rate' => $rate . ' ' . $currency,
                'the number of overtime hours in a given month' => $overtime,
                'overtime rate' => $rate * $overtimeMultiplier . ' ' . $currency,
                'total salary' => $salary,
            ];
        }

        if (Carbon::hasFormat($data['date'], 'Y-m-d')) {
            $workingTime = $employee->getDailyWorkingTime($data['date']);
            $salary      = $this->salaryService->calculateDailySalary($workingTime);

            return [
                'number of hours a given day' => $workingTime,
                'rate' => $rate . ' ' . $currency,
                'total salary' => $salary,
            ];
        }

        return [
            'message' => 'Invalid date format',
        ];
    }
}