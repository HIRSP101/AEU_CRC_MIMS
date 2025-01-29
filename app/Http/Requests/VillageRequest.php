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
            "village_name" => "nullable|string",
            "registration_date" => "nullable|date",
        ];
    }
}