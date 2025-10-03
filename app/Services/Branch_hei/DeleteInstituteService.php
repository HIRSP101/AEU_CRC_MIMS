<?php

namespace App\Services\Branch_hei;

use App\Models\branch_hei;
use Illuminate\Http\JsonResponse;
use Exception;

class DeleteInstituteService
{
    public function deleteInstitute($id)
    {
        try {
            $branch_hei = branch_hei::findOrFail($id);
            $branch_hei->delete();
            return response()->json(['message' => 'Institute deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete institute: ' . $e->getMessage()], 500);
        }
    }
}
