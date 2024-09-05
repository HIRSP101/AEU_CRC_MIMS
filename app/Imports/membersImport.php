<?php

namespace App\Imports;

use App\Models\member_personal_detail;
use Maatwebsite\Excel\Concerns\ToModel;

class membersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new member_personal_detail([
            
        ]);
    }
}
