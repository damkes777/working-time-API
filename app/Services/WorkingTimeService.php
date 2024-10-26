<?php

namespace App\Services;

use Carbon\Carbon;

class WorkingTimeService
{
    public function getStartDay(string $workStartTime): string
    {
        return Carbon::parse($workStartTime)
                     ->format('Y-m-d');
    }
}
