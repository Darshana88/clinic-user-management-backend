<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicianRequest extends FormRequest
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
        $clinicianId = $this->route('clinician') ?? $this->route('id');
        return [
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:clinicians,email,' . $clinicianId,
            'phone' => 'nullable|string|regex:/^[0-9\-\+\(\) ]*$/',
            'role' => 'sometimes|required|in:Psychotherapist,Case Manager,Navigator',
            'location' => 'sometimes|required|in:AL,AK,AZ,AR,CA,CO,CT,DE,FL,GA,HI,ID,IL,IN,IA,KS,KY,LA,ME,MD,MA,MI,MN,MS,MO,MT,NE,NV,NH,NJ,NM,NY,NC,ND,OH,OK,OR,PA,RI,SC,SD,TN,TX,UT,VT,VA,WA,WV,WI,WY',
            'languages' => 'sometimes|required|array',
            'languages.*' => 'in:English,Spanish,Portuguese',
            'supervising_clinician_id' => 'nullable|exists:clinicians,id',
            'status' => 'sometimes|required|in:Active,Inactive',
        ];
    }
}
