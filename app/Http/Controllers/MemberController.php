<?php

namespace App\Http\Controllers;

use App\Events\ImportProgress;
use App\Models\Branch;
use App\Models\branch_hei;
use App\Models\member_personal_detail;
use App\Http\Requests\MemberRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Services\Members\DeleteMemberService;
use App\Services\Members\CreateMemberService;
use App\Services\Members\UpdateMemberService;
use Spatie\Browsershot\Browsershot;

use Exception;
use Log;
use SebastianBergmann\Diff\Chunk;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use function Psy\debug;

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
    public function getMemberDetail($id): View
    {
        $member = member_personal_detail::with([
            'member_guardian_detail',
            'member_registration_detail',
            'member_education_background',
            'member_current_address',
            'member_pob_address'
        ])->findOrFail($id);
        // dd($member);

        return view('member_detail.index', compact('member'));
    }

    public function getRequestForm($r_id)
    {
        $member = DB::table('member_personal_detail as mpd')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->join('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->join('school as s', 'meb.school_id', '=', 's.school_id')
            ->join('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->where('mpd.member_id', $r_id)
            ->select(
                'mpd.*',
                'mgd.*',
                'mrd.*',
                'meb.*',
                'mca.*',
                'mpa.*',
                's.school_name',
                'b.branch_kh'
            )
            ->first();

        return view('member_detail.option.request-form', compact('member'));
    }

    public function getMemberCard($c_id)
    {
        $member = DB::table('member_personal_detail as mpd')
            ->join('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->join('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->join('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->join('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->join('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->join('school as s', 'meb.school_id', '=', 's.school_id')
            ->join('branch as b', 'b.branch_id', '=', 'meb.branch_id')
            ->where('mpd.member_id', $c_id)
            ->select(
                'mpd.*',
                'mgd.*',
                'mrd.*',
                'meb.*',
                'mca.*',
                'mpa.*',
                's.school_name',
                'b.branch_kh'
            )
            ->first();
        return view('member_detail.option.card', compact('member'));
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
    //new code 2025/03/27 import excel data into create member service
    public function importMember(Request $request): JsonResponse
    {    
        try {
            DB::beginTransaction();

            $members = $request->input('members');
            //dd($members);
            $currentMemberId = member_personal_detail::latest()->first()?->member_id ?? 0;

            foreach ($members as $memberData) {
                $this->createService->importMember($memberData, $currentMemberId);
                $currentMemberId++;
            }
            DB::commit();
            return response()->json(['message' => 'Member record(s) created successfully!']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create member record(s): ' . $e->getMessage()], 500);
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

    public function getupdateMember(int $memberId)
    {

        $branches = Branch::all()->pluck('branch_kh', 'branch_id');
        $branchhei = branch_hei::all()->pluck('institute_kh', 'bhei_id');
        if ($memberId) {
            $member = member_personal_detail::with([
                'member_guardian_detail',
                'member_registration_detail',
                'member_education_background',
                'member_current_address',
                'member_pob_address'
            ])->findOrFail(intval($memberId));
            // dd($member);
            return view('member.update.update', compact('member', 'branches', 'branchhei'));
        }
    }
    public function updateMember(int $memberId, MemberRequest $request): JsonResponse
    {
        $members = json_decode($request->input('members'), true);
        try {
            DB::beginTransaction();
            $data = $this->updateService->updateMember($memberId, $members, $request->file('image'));
            DB::commit();
            return response()->json([
                'data' => $data,
                'message' => 'Member updated successfully!'
            ]);
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
