<?php
namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Models\branch;
use App\Models\branch_hei;
use App\Models\form_submits;
use App\Models\member_personal_detail;
use App\Models\school;
use App\Services\Members\CreateMemberService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class FormController extends Controller
{
    protected CreateMemberService $createService;
    public function __construct(CreateMemberService $createService)
    {
        $this->createService = $createService;
    }
    public function index($token)
    {
        $branches = branch::all()->pluck('branch_kh', 'branch_id');
        $branchhei = branch_hei::all()->pluck('institute_kh', 'bhei_id');
        $school = school::all()->pluck('school_name', 'school_id');
        $branchheiPrefixed = $branchhei->mapWithKeys(fn($value, $key) => ['bhei_' . $key => $value]);
        $schoolPrefixed = $school->mapWithKeys(fn($value, $key) => ['school_' . $key => $value]);

        $institutions = $branchheiPrefixed->toArray() + $schoolPrefixed->toArray();
        $tokenEntry = form_submits::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();
        if ($tokenEntry) {
            return view('member_input_form.index', compact('branches', 'institutions', 'token'));
        } else {
            return view('member_input_form.expire_view');
        }
    }

    public function submitForm(Request $request)
    {
        try {
            DB::beginTransaction();
            $members = json_decode($request->input('members'), true);
            $tokenEntry = form_submits::where('token', $members[0]['token'])
                ->where('expires_at', '>=', now())
                ->first();
            if ($tokenEntry) {
                $formSubmitId = $tokenEntry->id;
                $academic_year = $tokenEntry->academic_year;
                $currentMemberId = member_personal_detail::latest()->first()?->member_id ?? 0;
                $i = 0;
                foreach ($members as $memberData) {
                    $memberData['form_submits_id'] = $formSubmitId;
                    $memberData['acadmedic_year'] = $academic_year;
                    $memberId = $this->createService->createMember($memberData, $request->file('image'), $currentMemberId);
                    $currentMemberId++;
                    $i++;
                }
                //dd($i);
                DB::commit();
                return response()->json(['message' => 'Member record(s) created successfully!', 'data' => $memberId->member_id]);
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create member record(s): ' . $e->getMessage()], 500);
        }
    }

    public function memberRegDetail($id)
    {
        $branches = Branch::all()->pluck('branch_kh', 'branch_id');
        $branchhei = branch_hei::all()->pluck('institute_kh', 'bhei_id');
        $school = school::all()->pluck('school_name', 'school_id');

        $branchheiPrefixed = $branchhei->mapWithKeys(fn($value, $key) => ['bhei_' . $key => $value]);
        $schoolPrefixed = $school->mapWithKeys(fn($value, $key) => ['school_' . $key => $value]);

        $institutions = $branchheiPrefixed->toArray() + $schoolPrefixed->toArray();

        $member = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_guardian_detail as mgd', 'mpd.member_id', '=', 'mgd.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('member_current_address as mca', 'mpd.member_id', '=', 'mca.member_id')
            ->leftJoin('member_pob_address as mpa', 'mpd.member_id', '=', 'mpa.member_id')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('branch_hei as bh', 'meb.branchhei_id', '=', 'bh.bhei_id')
            ->leftJoin('branch as b', 'meb.branch_id', '=', 'b.branch_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('form_submits as form', 'mrd.form_submits_id', '=', 'form.id')
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
                'bh.institute_kh',
                'form.token',
            )
            ->first();


        return view('member_input_form.update', compact('member', 'branches', 'institutions'));
    }
}