<?php

namespace App\Services\Schools;
use App\Models\school;

class CreateSchoolService
{
    public function createSchool(array $data)
    {
        return school::create([
            "school_name" => $data['school_name'],
            "type" => $data['type'],
            "district" => $data['district'],
            "registration_date" => $data['registration_date'],
            "branch_id" => $data['branch_id'],
            "village_id" => $data['village_id']
        ]);
    }
}