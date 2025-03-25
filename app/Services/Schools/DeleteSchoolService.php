<?php

namespace App\Services\Schools;

use App\Models\school;
use Illuminate\Http\JsonResponse;
use Exception;

class DeleteSchoolService
{
    public function deleteSchool($id)
    {
        try {
            $school = school::findOrFail($id);
            $school->delete();
            return response()->json(['message' => 'School deleted successfully']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete school: ' . $e->getMessage()], 500);
        }
    }
}
