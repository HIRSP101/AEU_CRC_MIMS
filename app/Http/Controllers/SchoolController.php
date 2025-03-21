<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\branch;
use App\Models\branch_bindding_user;
use App\Models\school;
use App\Models\district;
use App\Services\Schools\CreateSchoolService;

class SchoolController extends Controller
{
    public function index1($branchId, $villageId)
    {
        $village = DB::table('district')
            ->where('district_id', $villageId)
            ->select('district_name')
            ->first();

        $schools = DB::table('school as s')
            ->leftJoin('district as v', function ($join) {
                $join->on('v.district_id', '=', 's.district_id')
                    ->on('s.branch_id', '=', 'v.branch_id');
            })
            ->leftJoin('member_education_background as meb', function ($join) {
                $join->on('meb.school_id', '=', 's.school_id')
                    ->on('meb.branch_id', '=', 's.branch_id');
            })
            ->leftJoin('member_personal_detail as mpd', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->where('s.branch_id', $branchId)
            ->where('s.district_id', $villageId)
            ->select(
                's.school_id',
                's.school_name',
                's.type',
                's.village_name',
                //DB::raw('COUNT(meb.member_id) as total_mem')
                DB::raw("COUNT(CASE WHEN mrd.registration_date > NOW() - INTERVAL 6 YEAR THEN meb.member_id END) as total_mem")
            )
            ->groupBy('s.school_id', 's.school_name', 's.type', 's.village_name')
            ->get();

        return view('school.index', compact('schools', 'branchId', 'villageId', 'village'));
    }

    public function get(Request $request, $branchId = null, $villageId = null, $schoolId = null)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        //dd($branchId);
        $query = DB::table('member_personal_detail as mpd')
            ->leftJoin('member_education_background as meb', 'mpd.member_id', '=', 'meb.member_id')
            ->leftJoin('member_registration_detail as mrd', 'mpd.member_id', '=', 'mrd.member_id')
            ->leftJoin('branch as b', 'meb.branch_id', '=', 'b.branch_id')
            ->leftJoin('school as s', 'meb.school_id', '=', 's.school_id')
            ->leftJoin('district as v', 'v.district_id', '=', 's.district_id')
            ->whereRaw('mrd.registration_date > NOW() - INTERVAL 6 YEAR')
            ->select([
                'mpd.member_id',
                'mpd.member_code',
                'mpd.name_kh',
                'mpd.name_en',
                'mpd.gender',
                'mpd.date_of_birth',
                'b.branch_name',
                'b.branch_kh',
                'mpd.member_type',
                's.school_name',
                'meb.education_level',
                'meb.acadmedic_year',
                'mrd.registration_date',
                'mrd.expiration_date',
                'mpd.full_current_address',
                'mpd.phone_number',
                'mpd.email',
                'mpd.shirt_size',
            ]);

        if ($branchId) {
            $query->where('meb.branch_id', $branchId);
        }

        if ($villageId) {
            $query->where('s.district_id', $villageId);
        }

        if ($schoolId) {
            $query->where('meb.school_id', $schoolId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('mrd.registration_date', [$startDate, $endDate]);
        }

        $currentSchool = null;
        if ($schoolId) {
            $currentSchool = DB::table('school')
                ->select('school_name')
                ->where('school_id', $schoolId)
                ->first();
        }

        $data = $query->get();
        //dd($data);
        return view('totalmemSchool.index', [
            'data' => $data,
            'branchId' => $branchId,
            'villageId' => $villageId,
            'schoolId' => $schoolId,
            'currentSchool' => $currentSchool
        ]);
    }

    public function create($branchId, $villageId)
    {
        $user = branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id;
        $branch = DB::table('branch')->where('branch_id', $branchId)->first();
        $village = DB::table('district')->where('district_id', $villageId)->first();
        $branches = DB::table('branch')
            ->where('branch_id', $branchId)
            ->get();
        $villages = DB::table('district')->where('branch_id', $branchId)->get();

        return view('school.create-school', compact('branch', 'village', 'branches', 'villages'));
    }
    public function store(SchoolRequest $request, CreateSchoolService $service)
    {
        $data = $request->validated();
        $data['branch_id'] = $request->route('id');
        $data['district_id'] = $request->route('v_id');

        $school = $service->createSchool($data);

        return redirect()->route('school', ['id' => $school->branch_id, 'v_id' => $school->district_id])
            ->with('success', 'School created successfully');
    }

    // School 2
    public function create2()
    {
        $user = branch_bindding_user::where('user_id', auth()->user()->id)->first()->branch_id;
        $village = DB::table('district')->get();
        $branches = DB::table('branch')
            ->where('branch_id', $user)
            ->get();
        $villages = DB::table('district')->get();

        return view('school.create-school2', compact('village', 'branches', 'villages'));
    }

    public function store2(SchoolRequest $request, CreateSchoolService $service)
    {

        $request->validate([
            'school_name' => 'required|string|max:255',
            'type' => 'required|string',
            'registration_date' => 'required|date',
            'village_name' => 'required|string',
            'district_id' => 'required|exists:district,district_id',
            'branch_id' => 'required|exists:branch,branch_id',
            'khom' => 'required|string'
        ]);
        if ($request->type == 'សាកលវិទ្យាល័យ') {
            $branch = branch::where('branch_id', '=', $request->input('branch_id'))->first();
            $district = district::where('district_id', $request->input('district_id'))->first();
            $school = DB::table('branch_hei')->insertGetId([
                'institute_kh' => $request->input('school_name'),
                'type' => $request->input('typeUniversity'),
                'institute_type' => $request->input('type'),
                'village' => $request->input('village_name'),
                'commune_sangkat' => $request->input('khom'),
                'registered_at' => $request->input('registration_date'),
                'branch_id' => $request->input('branch_id'),
                'district_khan' => $district->district_name,
                'provience_city' => $branch->branch_kh,
            ]);
        } else {
            $school = DB::table('school')->insertGetId([
                'school_name' => $request->input('school_name'),
                'type' => $request->input('type'),
                'village_name' => $request->input('village_name'),
                'registration_date' => $request->input('registration_date'),
                'branch_id' => $request->input('branch_id'),
                'district_id' => $request->input('district_id'),
                'khom' => $request->input('khom')
            ]);
        }

        return redirect()->route('createschool')->with('success', 'School created successfully.');
    }
}
