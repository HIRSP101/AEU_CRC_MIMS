<?php

namespace App\Http\Controllers;

use App\Events\ImportProgress;
use App\Models\branch;
use App\Models\branch_hei;
use App\Models\member_personal_detail;
use App\Http\Requests\MemberRequest;
use App\Models\school;
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
        $title = "បញ្ចូលសមាជិកតាមរយះទម្រង់";
        $branches = Branch::all()->pluck('branch_kh', 'branch_id');
        $branchhei = branch_hei::all()->pluck('institute_kh', 'bhei_id');
        $school = school::all()->pluck('school_name', 'school_id');
        $branchheiPrefixed = $branchhei->mapWithKeys(fn($value, $key) => ['bhei_' . $key => $value]);
        $schoolPrefixed = $school->mapWithKeys(fn($value, $key) => ['school_' . $key => $value]);

        $institutions = $branchheiPrefixed->toArray() + $schoolPrefixed->toArray();
        return view('member.index', compact('branches', 'institutions', 'title'));
    }
    public function getMemberDetail($id): View
    {
        $member = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->leftJoin('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('branch_hei as bh', 'meb.branchhei_id', '=', 'bh.bhei_id')
            ->leftJoin('branch as b', 'meb.branch_id', '=', 'b.branch_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->where('mpd.member_id', $id)
            ->select(
                'mpd.*',
                'mgd.*',
                'mrd.*',
                'mca.village as current_village',
                'mca.district_khan as current_district',
                'mca.provience_city as current_province',
                'mca.commune_sangkat as current_commune',
                'mca.street_no as current_street',
                'mca.home_no as current_house_number',
                'mpa.village as pob_village',
                'mpa.district_khan as pob_district',
                'mpa.provience_city as pob_province',
                'mpa.commune_sangkat as pob_commune',
                'meb.*',
                'b.branch_kh',
                's.school_name',
                'bh.institute_kh'
            )
            ->first();

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
                $member = $this->createService->createMember($memberData, $request->file('image'), $currentMemberId);
                if (!$member) {
                    DB::rollBack();
                    return response()->json(['error' => 'Member already exists: ' . ($memberData['name_kh'] ?? 'Unknown')], 404);
                }
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
        ini_set('max_execution_time', 120);
        try {
            DB::beginTransaction();

            $members = $request->input('members');
            // dd($members);
            $currentMemberId = member_personal_detail::latest()->first()?->member_id ?? 0;
            $faileds = [];
            $failed_counter = 0;
            $iterator = 0;
            foreach ($members as $memberData) {
                [$constraint, $member] = $this->createService->importMember($memberData, $currentMemberId);
                if (!$constraint) {
                    $faileds[] = $member;
                    $failed_counter++;
                }
                $currentMemberId++;
                $iterator++;
            }

            DB::commit();
            return response()->json(['message' => 'Member record(s) created successfully!', 'failed_counter' => $failed_counter, 'faileds' => $faileds], 200);
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
        $title = "កែប្រែទិន្នន័យសមាជិក";
        $branches = Branch::all()->pluck('branch_kh', 'branch_id');
        $branchhei = branch_hei::all()->pluck('institute_kh', 'bhei_id');
        $school = school::all()->pluck('school_name', 'school_id');

        $branchheiPrefixed = $branchhei->mapWithKeys(fn($value, $key) => ['bhei_' . $key => $value]);
        $schoolPrefixed = $school->mapWithKeys(fn($value, $key) => ['school_' . $key => $value]);

        $institutions = $branchheiPrefixed->toArray() + $schoolPrefixed->toArray();

        if ($memberId) {
            $member = DB::table('member_personal_detail as mpd')
                ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
                ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
                ->leftJoin('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
                ->leftJoin('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
                ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
                ->leftJoin('branch_hei as bh', 'meb.branchhei_id', '=', 'bh.bhei_id')
                ->leftJoin('branch as b', 'meb.branch_id', '=', 'b.branch_id')
                ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
                ->where('mpd.member_id', $memberId)
                ->select(
                    'mpd.*',
                    'mgd.*',
                    'mrd.*',
                    'mca.village as current_village',
                    'mca.district_khan as current_district',
                    'mca.provience_city as current_province',
                    'mca.commune_sangkat as current_commune',
                    'mca.street_no as current_street',
                    'mca.home_no as current_house_number',
                    'mpa.village as pob_village',
                    'mpa.district_khan as pob_district',
                    'mpa.provience_city as pob_province',
                    'mpa.commune_sangkat as pob_commune',
                    'meb.*',
                    'b.branch_kh',
                    's.school_name',
                    'bh.institute_kh'
                )
                ->first();
            // dd($member);
            return view('member.update.update', compact('member', 'branches', 'institutions', 'title'));
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
