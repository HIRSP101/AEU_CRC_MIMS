<?php

namespace App\Services\District;

use App\Models\district;
use Illuminate\Http\JsonResponse;
use Exception;

class DeleteDistrictService
{
    public function deleteDistrict($id)
    {
        try {
            $district = district::findOrFail($id);
            $district->delete();
            return response()->json(['message' => 'District deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete district: ' . $e->getMessage()], 500);
        }
    }
}
