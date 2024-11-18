<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ControlGroupRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $uniqueRule = 'required|string|max:255|unique:control_groups,name';
        
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $uniqueRule .= ',' . $this->route('controlGroup')->id;
        }

        return [
            'name' => $uniqueRule,
            //'description' => 'required|string'
        ];
    }
}