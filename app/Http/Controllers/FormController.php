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
            ->where('expires_at', '>=', now())
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
                //dd($members); 
                $currentMemberId = member_personal_detail::latest()->first()?->member_id ?? 0;
                foreach ($members as $memberData) {
                    $memberData['form_submits_id'] = $formSubmitId;
                    $memberData['acadmedic_year'] = $academic_year;
                    $this->createService->createMember($memberData, $request->file('image'), $currentMemberId);
                    $currentMemberId++;
                }
                DB::commit();
                return response()->json(['message' => 'Member record(s) created successfully!']);
            }

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create member record(s): ' . $e->getMessage()], 500);
        }
    }
}