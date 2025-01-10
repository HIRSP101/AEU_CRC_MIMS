<?php

namespace App\Services\Members;

use App\Models\member_personal_detail;
use Illuminate\Http\JsonResponse;
use Exception;

class DeleteMemberService
{

    public function deleteMembers($arr_id): JsonResponse
    {
        try {
            member_personal_detail::whereIn('member_id', $arr_id)->delete();
            return response()->json(['message' => 'Members deleted successfully']);

        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete members: ' . $e->getMessage()], 500);
        }
    }
    public function deleteMember($id): JsonResponse
    {
        try {
            $member = member_personal_detail::findOrFail($id);
            $member->delete();
            return response()->json(['message' => 'Member deleted successfully']);

        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to delete member: ' . $e->getMessage()], 500);
        }
    }
}