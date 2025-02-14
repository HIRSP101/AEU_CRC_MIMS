<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VillageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "district_name" => "required|string",
            "registration_date" => "nullable|date",
            "branch_id" => "required|exists:branch,branch_id",
        ];
    }
}
