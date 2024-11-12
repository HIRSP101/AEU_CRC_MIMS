<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\member_personal_detail;
use App\Http\Requests\MemberRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Services\Members\DeleteMemberService;
use App\Services\Members\CreateMemberService;
use App\Services\Members\UpdateMemberService;
use Exception;

class MemberController extends Controller
{
    protected CreateMemberService $createService;
    protected UpdateMemberService $updateService;
    protected DeleteMemberService $deleteService;

    public function __construct(CreateMemberService $createService, UpdateMemberService $updateService, DeleteMemberService $deleteService)   
    {
        $this->deleteService = $deleteService;  
        $this->createService = $createService;
        $this->updateService = $updateService;
    }
    public function index(): View
    {
        $branches = Branch::all()->pluck('branch_kh', 'branch_id');
        return view('member.index', compact('branches'));
    }
    public function getMemberDetail(Request $request): View
    {
        $member = member_personal_detail::with([
            'member_guardian_detail',
            'member_registration_detail',
            'member_education_background',
            'member_current_address',
            'member_pob_address'
        ])->findOrFail($request->id);

        return view('member_detail.index', compact('member'));
    }
    public function insertMember(MemberRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $members = json_decode($request->input('members'), true);
            //dd($members);
            $currentMemberId = member_personal_detail::latest()->first()?->member_id ?? 0;

            foreach ($members as $memberData) {
                $this->createService->createMember($memberData, $request->file('image'), $currentMemberId);
                $currentMemberId++;
            }

            DB::commit();
            return response()->json(['message' => 'Member record(s) created successfully!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create member record(s): ' . $e->getMessage()], 500);
        }
    }

    public function updateMember(int $memberId, MemberRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            
            $this->updateService->updateMember($memberId, $request->all(), $request->file('image'));

            DB::commit();
            return response()->json(['message' => 'Member updated successfully!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update member: ' . $e->getMessage()], 500);
        }
    }
    // multiple delete
    public function deleteMembers(Request $request): JsonResponse
    {
        $this->deleteService->deleteMembers($request->arr);
        return response()->json(['message' => 'Members deleted successfully']);
    }
    // single delete
    public function deleteMember(Request $request): JsonResponse
    {
       $this->deleteService->deleteMember($request->id);
       return response()->json(['message' => 'Member deleted successfully']);
    }
}