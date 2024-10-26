<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'      => 'required|string',
            'last_name' => 'required|string',
        ];
    }
}
