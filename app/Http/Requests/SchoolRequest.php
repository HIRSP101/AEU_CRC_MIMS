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
            "district" => "required|string",
            "registration_date" => "nullable|date",
            "branch_id" => "required|exists:branch,branch_id",
            "village_id" => "required|exists:village,village_id"
        ];
    }
}