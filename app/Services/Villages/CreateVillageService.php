<?php
namespace App\Services\Villages;
use App\Models\village;

class CreateVillageService
{
    public function createVillage(array $data): village
    {
        return village::create([
            "village_name" => $data['village_name'],
            "registration_date" => $data['registration_date'] ?? null,
            "branch_id" => $data['branch_id'],
        ]);
    }
}