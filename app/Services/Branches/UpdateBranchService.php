<?php

namespace App\Services\Branches;

use App\Models\branch;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use App\Models\branch_hei;
use Illuminate\Support\Facades\File;
use App\Services\Branches\CreateBranchService;

class UpdateBranchService
{
    public function updateBranch($data, ?UploadedFile $image, int $bheiId): branch_hei
    {
        $branch = branch_hei::findOrFail($bheiId);

        if ($image && $branch->image && File::exists(public_path($branch->image))) {
            File::delete(public_path($branch->image));
        }

        $imagePath = $this->handleImageUpload($data, $image, $bheiId) ?? $branch->image;
        //  dd($data);
        $createBranchService = new CreateBranchService();
        $attributes = $createBranchService->branch_hei_attributes($data, $imagePath);
        $branch->update($attributes);

       //  dd($branch);
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
}
