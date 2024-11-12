<?php

namespace App\Services\Branches;

use App\Models\branch_hei;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Http\JsonResponse;
use Exception;

class DeleteBranchService
{
    public function deleteBranches($arr_id): JsonResponse
    {
        try {
            // Retrieve records with images before deletion
            $branches = branch_hei::whereIn('bhei_id', $arr_id)->get();

            foreach ($branches as $branch) {
                // Delete the image if it exists
                if ($branch->image && File::exists(public_path($branch->image))) {
                    File::delete(public_path($branch->image));
                }
            }

            // Delete branch_hei records
            branch_hei::whereIn('bhei_id', $arr_id)->delete();

            return response()->json(['message' => 'Members deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete members: ' . $e->getMessage()], 500);
        }
    }

    public function deleteBranch($id): JsonResponse
    {
        try {
           // dd($id);
            $member = branch_hei::findOrFail($id);

            // Delete the image if it exists
            if ($member->image && File::exists(public_path($member->image))) {
                File::delete(public_path($member->image));
            }

            // Delete branch_hei record
            $member->delete();

            return response()->json(['message' => 'Member deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete member: ' . $e->getMessage()], 500);
        }
    }
}
