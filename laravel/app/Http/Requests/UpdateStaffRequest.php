<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $staffId = $this->route('staff') ?? $this->route('id');
        return [
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:staff,email,' . $staffId,
            'phone' => 'nullable|string|regex:/^[0-9\-\+\(\) ]*$/',
            'role' => 'sometimes|required|in:Practice Owner,Director,Front Office Admin,Records Custodian',
            'status' => 'sometimes|required|in:Active,Inactive',
        ];
    }
}
