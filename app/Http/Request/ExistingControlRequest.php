<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExistingControlRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'control_group_id' => 'required|exists:control_groups,id',
            //'status' => 'required|in:Active,Inactive'
        ];
    }
}