<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeRegistrationRequest;
use App\Http\Requests\WorkingTimeSummaryRequest;
use App\Services\WorkingTime\WorkingTimeService;
use Illuminate\Http\JsonResponse;

class WorkingTimesController
{
    public function __construct(
        protected WorkingTimeService $workingTimeService
    ) {
    }

    public function timeRegistration(TimeRegistrationRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $message = $this->workingTimeService->registerTime($validated);

        return response()->json($message);
    }

    public function workingTimeSummary(WorkingTimeSummaryRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $message = $this->workingTimeService->summaryWorkingTime($validated);

        return response()->json($message);
    }
}