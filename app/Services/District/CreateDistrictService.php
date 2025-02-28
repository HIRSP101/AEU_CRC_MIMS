<?php

namespace App\Services\Villages;

use App\Models\district;

class CreateDistrictService
{
    public function createDistrict(array $data): district
    {
        return district::create([
            "district_name" => $data['district_name'],
            "registration_date" => $data['registration_date'] ?? null,
            "branch_id" => $data['branch_id'],
        ]);
    }
}
