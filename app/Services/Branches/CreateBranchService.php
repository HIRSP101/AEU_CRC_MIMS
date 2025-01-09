<?php

namespace App\Services\Branches;

use App\Models\branch;
use App\Models\branch_hei;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class CreateBranchService
{
    public function createBranch($data, ?UploadedFile $image, int $bheiId): branch_hei
    {
        $imagePath = $this->handleImageUpload($data, $image, $bheiId);
        //dd($data);
        $branch = branch_hei::create(attributes: $this->branch_hei_attributes($data, $imagePath)); 
        $branch = branch::create(attributes: $this->branch_attributes($data, $imagePath));
        //dd($data);
        return $branch;
    }
    private function handleImageUpload($data, ?UploadedFile $image, int $bheiId): ?string
    {
        if (!$image || !isset($data->branchName)) {
            return null;
        }

        $imageName = 'branches/bran-' . str_replace(' ', '', $data["branchName"] . ($bheiId + 1)) . '.' . $image->extension();
        $image->move(public_path('images/branches'), $imageName);
        
        return "images/$imageName";
    }
    public function branch_hei_attributes($data, $imagePath){
        $provience_id = explode(" ",$data->provinceOrCity);
        $arr = [
            "institute_name" => $data->branchName,
            "institute_kh" => $data->branchName,
            "type" => $data->typeofBranch,
            "village"=> $data->village,
            "commune_sangkat"=> $data->communceOrKhan,
            "district_khan"=> $data->district,
            "provience_city"=> $provience_id[0],
            "registered_at"=> $data->recruitementDate,
            "established_at"=> $data->createDate,
            "branch_id" => $provience_id[1],
            "image"=> $imagePath,
            "institute_type" => $data->branchLevel,
        ];
        return $arr;
    }
    
    public function branch_attributes($data, $imagePath) {
        $arr = [
            "branch_name" => $data->branchName,
            "branch_kh" => $data->branchName,
            "image"=> $imagePath,
        ];
        return $arr;
    }
}