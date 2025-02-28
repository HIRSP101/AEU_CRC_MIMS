<?php

namespace App\Services\Schools;

use App\Models\school;

class CreateSchoolService
{
    public function createSchool(array $data)
    {
        return school::create([
            "school_name" => $data['school_name'],
            "school_type" => $data['school_type'],
            "village_name" => $data['village_name'],
            "registration_date" => $data['registration_date'],
            "branch_id" => $data['branch_id'],
            "district_id" => $data['district_id']
        ]);
    }
}
