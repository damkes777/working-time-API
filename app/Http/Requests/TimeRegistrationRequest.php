<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimeRegistrationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'employee_uuid' => 'required|string|exists:employees,uuid',
            'work_start' => 'required|date_format:Y-m-d H:i',
            'work_end' => 'required|date_format:Y-m-d H:i',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
