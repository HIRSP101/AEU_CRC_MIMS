<?php

namespace App\Services\Members;

use App\Models\member_personal_detail;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Support\Facades\DB;

class DeleteMemberService
{
    public function deleteMember($id): JsonResponse
    {
        DB::beginTransaction();
        try {
            DB::table('member_current_address')->where('member_id', $id)->delete();
            DB::table('member_education_background')->where('member_id', $id)->delete();
            DB::table('member_engagement_detail')->where('member_id', $id)->delete();
            DB::table('member_guardian_detail')->where('member_id', $id)->delete();
            DB::table('member_middle_management')->where('member_id', $id)->delete();
            DB::table('member_pob_address')->where('member_id', $id)->delete();
            DB::table('member_registration_detail')->where('member_id', $id)->delete();
            DB::table('member_top_management')->where('member_id', $id)->delete();
            DB::table('membership_detail')->where('member_id', $id)->delete();
            
            DB::table('member_personal_detail')->where('member_id', $id)->delete();

            DB::commit();

            return response()->json(['message' => 'Member deleted successfully']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete member: ' . $e->getMessage()], 500);
        }
    }

    public function deleteMembers(array $arr_id): JsonResponse
    {
        DB::beginTransaction();
        try {
            foreach ($arr_id as $id) {
                $this->deleteMember($id);
            }
            DB::commit();
            return response()->json(['message' => 'Members deleted successfully']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete members: ' . $e->getMessage()], 500);
        }
    }
}