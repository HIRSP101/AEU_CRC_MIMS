<?php

namespace App\Http\Controllers;

use App\Events\ImportProgress;
use App\Models\Branch;
use App\Models\branch_hei;
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
use SebastianBergmann\Diff\Chunk;

class MemberController extends Controller
{
    protected CreateMemberService $createService;
    protected UpdateMemberService $updateService;
    protected DeleteMemberService $deleteService;

    private const CHUNK_SIZE = 100;

    public function __construct(CreateMemberService $createService, UpdateMemberService $updateService, DeleteMemberService $deleteService)
    {
        $this->deleteService = $deleteService;
        $this->createService = $createService;
        $this->updateService = $updateService;
    }
    public function index(): View
    {
        $branches = Branch::all()->pluck('branch_kh', 'branch_id');
        $branchhei = branch_hei::all()->pluck('institute_kh', 'bhei_id');
        return view('member.index', compact('branches', 'branchhei'));
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
    public function importMember(MemberRequest $request): JsonResponse
    {
       // dd($request);
        try {
            $members = json_decode($request->input('members'), true);
          //  dd($members);
            $totalMembers = count($members);

            if ($totalMembers === 0) {
                return response()->json(['message' => 'No members to process'], 400);
            }

            $currentMemberId = $this->getLastMemberId();
            $processed = 0;
            $errors = [];

      
            foreach (array_chunk($members, self::CHUNK_SIZE) as $chunk) {
                try {
                    DB::beginTransaction();

                    foreach ($chunk as $memberData) {
                        try {
                            $this->createService->createMember($memberData, $request->file('image'), $currentMemberId);
                            $currentMemberId++;
                            $processed++;

                   
                            if ($processed % 10 === 0) {
                                $this->broadcastProgress($processed, $totalMembers);
                            }
                        } catch (Exception $e) {
                            // Log individual record errors but continue processing
                            $errors[] = [
                                'data' => $memberData,
                                'error' => $e->getMessage()
                            ];
                            continue;
                        }
                    }

                    DB::commit();

          
                    if (function_exists('opcache_reset')) {
                        opcache_reset();
                    }
                    gc_collect_cycles();
                } catch (Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            }
          
            $this->broadcastProgress($processed, $totalMembers);

            return response()->json([
                'message' => 'Member import completed',
                'total_processed' => $processed,
                'total_failed' => count($errors),
                'errors' => $errors,
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Import failed: ' . $e->getMessage(),
                'processed' => $processed ?? 0,
                'total' => $totalMembers ?? 0
            ], 500);
        }
    }

    private function getLastMemberId(): int
    {
        return DB::table('member_personal_detail')
            ->select('member_id')
            ->orderByDesc('member_id')
            ->limit(1)
            ->value('member_id') ?? 0;
    }

    private function broadcastProgress(int $processed, int $total): void
    {
        $progress = round(($processed / $total) * 100);
        broadcast(new ImportProgress($progress))->toOthers();

        if (connection_status() !== CONNECTION_NORMAL) {
            flush();
            ob_flush();
        }
    }

    public function updateMember(int $memberId, MemberRequest $request): JsonResponse
    {
        dd($request);
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
