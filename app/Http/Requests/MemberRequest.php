<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'members' => 'required',
            'members.*.name_kh' => 'required|string',
            'members.*.name_en' => 'required|string',
            'members.*.gender' => 'required|string',
            'members.*.nationality' => 'required|string',
            'members.*.date_of_birth' => 'required',
            'members.*.full_current_address' => 'required|string',
            'members.*.phone_number' => 'required|string',
            'members.*.email' => 'nullable|email',
            'members.*.facebook' => 'nullable|string',
            'members.*.shirt_size' => 'nullable|string',
            'members.*.branch_id' => 'nullable|exists:branches,id',
            
            'members.*.home_no' => 'nullable|string',
            'members.*.village' => 'nullable|string',
            'members.*.commune_sangkat' => 'nullable|string',
            'members.*.district_khan' => 'nullable|string',
            'members.*.provience_city' => 'nullable|string',
            
            'members.*.pob_village' => 'nullable|string',
            'members.*.pob_commune_sangkat' => 'nullable|string',
            'members.*.pob_district_khan' => 'nullable|string',
            'members.*.pob_provience_city' => 'nullable|string',
            
            'members.*.institute_id' => 'nullable|string',
            'members.*.acadmedic_year' => 'nullable|string',
            'members.*.major' => 'nullable|string',
            'members.*.language' => 'nullable|string',
            'members.*.computer_skill' => 'nullable|string',
            'members.*.misc_skill' => 'nullable|string',
            
            'members.*.father_name' => 'nullable|string',
            'members.*.father_dob' => 'nullable',
            'members.*.father_occupation' => 'nullable|string',
            'members.*.father_current_address' => 'nullable|string',
            'members.*.mother_name' => 'nullable|string',
            'members.*.mother_dob' => 'nullable|date',
            'members.*.mother_occupation' => 'nullable|string',
            'members.*.mother_current_address' => 'nullable|string',
            'members.*.guardian_phone' => 'nullable|string',
            
            'members.*.registration_date' => 'required|date',
        ];
    }
    public function messages(): array
    {
        return [
            'members.required' => 'Member data is required',
        
        ];
    }
}