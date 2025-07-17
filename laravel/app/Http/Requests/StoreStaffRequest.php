<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStaffRequest extends FormRequest
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
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:staff,email',
            'phone' => 'nullable|string|regex:/^[0-9\-\+\(\) ]*$/',
            'role' => 'required|in:Practice Owner,Director,Front Office Admin,Records Custodian',
            'status' => 'required|in:Active,Inactive',
        ];
    }
}
