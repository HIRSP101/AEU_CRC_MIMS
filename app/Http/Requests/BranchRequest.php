<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            "branchName" => "nullable|string",
            "typeofBranch" => "nullable|string",
            "branchLevel" => "nullable|string",
            "village" => "nullable|string",
            "district" => "nullable|string",
            "communeOrKhan" => "nullable|string",
            "provinceOrCity" => "nullable|string",
            "createDate" => "nullable|date",
            "recruitmentDate" => "nullable|date",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages(): array
    {
        return [
            'image.image' => 'The file must be an image',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg',
            'image.max' => 'The image must not be larger than 2MB',
        ];
    }
}