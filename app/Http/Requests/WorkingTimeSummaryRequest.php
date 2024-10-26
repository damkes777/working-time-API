<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkingTimeSummaryRequest extends FormRequest
{
    public function rules()
    {
        return [
            'employee_uuid' => 'required|string|exists:employees,uuid',
            'date' => 'required|date',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
