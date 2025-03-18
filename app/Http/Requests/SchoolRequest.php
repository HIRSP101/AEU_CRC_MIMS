<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "school_name" => "required|string",
            "type" => "required|string",
            "village_name" => "required|string",
            "registration_date" => "nullable|date",
            "branch_id" => "required|exists:branch,branch_id",
            "district_id" => "required|exists:district,district_id",
            "khom" => "required|string"
        ];
    }
}
