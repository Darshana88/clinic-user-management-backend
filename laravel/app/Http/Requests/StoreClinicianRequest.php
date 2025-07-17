<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClinicianRequest extends FormRequest
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
            'email' => 'required|email|unique:clinicians,email',
            'phone' => 'nullable|string|regex:/^[0-9\-\+\(\) ]*$/',
            'role' => 'required|in:Psychotherapist,Case Manager,Navigator',
            'location' => 'required|in:AL,AK,AZ,AR,CA,CO,CT,DE,FL,GA,HI,ID,IL,IN,IA,KS,KY,LA,ME,MD,MA,MI,MN,MS,MO,MT,NE,NV,NH,NJ,NM,NY,NC,ND,OH,OK,OR,PA,RI,SC,SD,TN,TX,UT,VT,VA,WA,WV,WI,WY',
            'languages' => 'required|array',
            'languages.*' => 'in:English,Spanish,Portuguese',
            'supervising_clinician_id' => 'nullable|exists:clinicians,id',
            'status' => 'required|in:Active,Inactive',
        ];
    }
}
